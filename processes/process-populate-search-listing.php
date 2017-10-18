<?php
session_start();
include 'processes/process-populate-search-form.php';
$search_output = "";
error_reporting(E_ALL);
ini_set('display_errors', '1');
if(isset($_POST['submit_search'])){
$search_bar = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['search_bar']);
$search_bar = "%" . $search_bar . "%";



$stmt = $mysqli->prepare("SELECT listing_id, address, price, bed_no, bath_no, property_des, featured_image, title, garage_no FROM properties WHERE MATCH(title) AGAINST  (?) OR categories = ? AND type = ?");
$stmt->bind_param("sii", $search_bar, $_POST['city'], $_POST['type']);
$stmt->execute();
$result = $stmt->get_result();



if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $arr[] = $row;
    $listing_id = $row['listing_id'];
    $search_output = $search_output . "

        <tr>
        <td> $listing_id<br> <a class='view-listing' href='product.php?listing_id=$listing_id'><img width='250' height='200px'  src='images/uploads/$row[featured_image]'></td>
        <td><a><h4 style='color: #42b3f4'>$row[title]</h4><p style='color: grey'>$row[address]</p><hr>
        <p>$row[property_des]</p>
        <h4>$ $row[price]</h4>
      
        <p><i class='fa fa-bed' aria-hidden='true'></i>  : $row[bed_no] <i class='fa fa-bath' aria-hidden='true'></i> : $row[bath_no] <i class='fa fa-car' aria-hidden='true'></i> : $row[garage_no]</p>


        </tr>";


}
} else{
  echo "no listins to show";
}
$stmt->close();



}
$_SESSION['search_output'] = $search_output;

?>
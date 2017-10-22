<?php
session_start();
include 'processes/process-populate-search-form.php';
$search_output = "";
$search_output2 = "";
error_reporting(E_ALL);
ini_set('display_errors', '1');
if(isset($_POST['submit_search'])){
$search_bar = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['search_bar']);
$search_bar = "%" . $search_bar . "%";

// select query based on user input

$stmt = $mysqli->prepare("SELECT listing_id, address, price, bed_no, bath_no, property_des, featured_image, title, garage_no FROM properties WHERE MATCH(title) AGAINST  (?) OR categories = ? AND type = ?");
$stmt->bind_param("sii", $search_bar, $_POST['city'], $_POST['type']);
$stmt->execute();
$result = $stmt->get_result();




if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $arr[] = $row;
    $listing_id = $row['listing_id'];


// max charectors 200
    $string = $row['property_des'] . "";
   $string = substr($string, 0, 200);

    // Convert decimal from DB to currency to display on the page
   		$price = $row['price'];
      $number = $price;
      setlocale(LC_MONETARY,"en_NZ");
      $price = money_format("%.0n", $number);

// populate search listings
    $search_output = $search_output . "

        <tr>
        <td> <a class='view-listing' href='product.php?listing_id=$listing_id'><img width='280' height='200px'  src='images/uploads/$row[featured_image]'></a></td>
        <td><a class='view-listing' href='product.php?listing_id=$listing_id'><h4 >$row[title]</h4></a><a id= 'wishlist-icon' href='guest-login.php' action= 'post' ><i class='fa fa-heart' aria-hidden='true'>  Add to Wishlist</i></a><p style='color: grey'>$row[address] </p><hr>
        <p>$string ...</p>
        <h4>$price</h4>
      
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




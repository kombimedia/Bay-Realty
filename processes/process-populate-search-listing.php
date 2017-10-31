<?php
// session_start();
include 'processes/process-populate-search-form.php';
$search_output = "";
$search_output2 = "";
error_reporting(E_ALL);
ini_set('display_errors', '1');

if (isset($_POST['city'])) {
    $_POST['city'] = $_POST['city'];
} else {
    $_POST['city'] = "";
}
if (isset($_POST['type'])) {
    $_POST['type'] = $_POST['type'];
} else {
    $_POST['type'] = "";
}

if (isset($_POST['submit_search'])) {
    $search_bar = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['search_bar']);
    $search_bar = "%" . $search_bar . "%";

// select query based on user input

// $stmt = $mysqli->prepare("SELECT listing_id, address, price, bed_no, bath_no, property_des, featured_image, title, garage_no FROM properties WHERE property_des LIKE ? OR categories = ? AND type = ?");
// $stmt->bind_param("sii", $search_bar, $_POST['city'], $_POST['type']);
// $stmt->execute();
// $result = $stmt->get_result();
// select query based on user input in search bar
if ($_POST['search_bar'] != "") {
    $stmt = $mysqli->prepare("SELECT listing_id, address, price, bed_no, bath_no, property_des, featured_image, title, garage_no, sell_method FROM properties WHERE property_des LIKE ? OR title LIKE ?");
    $stmt->bind_param("ss", $search_bar, $search_bar);
    $stmt->execute();
    $result = $stmt->get_result();
// select query based on  what user has selected 
} elseif ($_POST['city'] != "" && $_POST['type'] != "" ) {
    $stmt = $mysqli->prepare("SELECT listing_id, address, price, bed_no, bath_no, property_des, featured_image, title, garage_no, sell_method FROM properties WHERE categories = ? AND type = ?");
    $stmt->bind_param("ii", $_POST['city'], $_POST['type']);
    $stmt->execute();
    $result = $stmt->get_result();
// select query based what user has selected
} else {
    $stmt = $mysqli->prepare("SELECT listing_id, address, price, bed_no, bath_no, property_des, featured_image, title, garage_no, sell_method FROM properties WHERE categories = ? OR type = ?");
    $stmt->bind_param("ii", $_POST['city'], $_POST['type']);
    $stmt->execute();
    $result = $stmt->get_result();
}


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

      // Display the sell method if populated in listing
      if ($row['sell_method'] !== "") {
                $price = $row['sell_method'];
            }

// populate search listings
    $search_output = $search_output . "

        <tr>
        <td> <a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><img width='280' height='200px'  src='images/uploads/$row[featured_image]'></a></td>
        <td><a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><h4 >$row[title]</h4></a><a id= 'wishlist-icon' href='processes/process-wishlist-button.php?listing_id=$listing_id' action= 'post' ><i class='fa fa-heart' aria-hidden='true'>  Add to Wishlist</i></a><p style='color: grey'>$row[address] </p><hr>
        <p>$string ...</p>
        <h4>$price</h4>

        <p><i class='fa fa-bed pr-2' aria-hidden='true'></i>$row[bed_no] <i class='fa fa-bath pl-2 pr-2' aria-hidden='true'></i>$row[bath_no] <i class='fa fa-car pl-2 pr-2' aria-hidden='true'></i>$row[garage_no]</p>


        </tr>";


}


} else{
  $_SESSION["noListings"] = "<div>No listings match your search criteria.</div>";
}
$stmt->close();



}
$_SESSION['search_output'] = $search_output;




?>




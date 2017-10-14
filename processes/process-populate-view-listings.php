<?php
$populate_view_listings = "";
$stmt1 = $mysqli->prepare("SELECT listing_id, agents, title, address, categories, type, price, sell_method, bed_no, bath_no, lounge_no, garage_no, house_size, land_size, featured_image, featured_property FROM properties");
$stmt1->execute();
$result1 = $stmt1->get_result();
// Check if there are any records to show
if($result1->num_rows > 0) {
  // Loop through data and save each row array to a variable
  while($row1 = $result1->fetch_assoc()) {
      $listing_id = $row1['listing_id'];
      $agents = $row1['agents'];
      $title = $row1['title'];
      $address = $row1['address'];
      $categories = $row1['categories'];
      $type = $row1['type'];
      $price = $row1['price'];
      $sell_method = $row1['sell_method'];
      $bed_no = $row1['bed_no'];
      $bath_no = $row1['bath_no'];
      $lounge_no = $row1['lounge_no'];
      $garage_no = $row1['garage_no'];
      $house_size = $row1['house_size'];
      $land_size = $row1['land_size'];
      $featured_image = $row1['featured_image'];
      $featured_property = $row1['featured_property'];
      // Convert decimal from DB to currency to display on the page
      $number = $price;
      setlocale(LC_MONETARY,"en_NZ");
      $price = money_format("%.0n", $number);
      // Check that check box returns 1 or null. We needed to display null as No and 1 as Yes
      if ($featured_property === 1) {
          $featured_property = "Yes";
        } else {
          $featured_property = "No";
        }

// Category, property type and agent are stored in the properties table as their ID. To convert this id to the string value we needed to loop through and compare the Id to the corresponding table (categories, property_type and agents) then output the matching value string e.g Cy Messenger instead of 1
$stmt = $mysqli->prepare("SELECT cat_id, city FROM categories");
$stmt->execute();
$result = $stmt->get_result();
// Loop through data and output each row
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    // define output field to compare against
    $cat_id = $row['cat_id'];
    // define field to output to listings table
    $city = $row['city'];
    // compare stored data to categories table and save ID as string value
    if ($categories == $cat_id) {
        $categories = $city;
      }
   }
}
$stmt->close();

$stmt = $mysqli->prepare("SELECT pt_id, type FROM property_type");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output each row
  while($row = $result->fetch_assoc()) {
    // define output field to compare against
    $pt_id = $row['pt_id'];
    // define field to output to listings table
    $property_type = $row['type'];
    // compare stored data to property_type table and save ID as string value
    if ($type == $pt_id) {
        $type = $property_type;
      }
   }
}
$stmt->close();

$stmt = $mysqli->prepare("SELECT agent_id, first_name, surname FROM agents");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output each row
  while($row = $result->fetch_assoc()) {
    // define output field to compare against
    $agent_id = $row['agent_id'];
    // define field to output to listings table
    $name = $row['first_name'] . " " . $row['surname'];
    // compare stored data to agents table and save ID as string value
    if ($agents == $agent_id) {
        $agents = $name;
      }
   }
}
$stmt->close();

$populate_view_listings = $populate_view_listings . "
          <tr>
              <td><img width='150' src='images/uploads/$featured_image'></td>
              <td> $listing_id<br> <a class='view-listing-edit' href='dashboard-update-listing.php?listing_id=$listing_id'>Edit</a> <a class='view-listing-delete' href='#' onClick='deletelisting($listing_id)'>Delete</a> </td>
              <td>$agents</td>
              <td>$title</td>
              <td>$address</td>
              <td>$categories</td>
              <td>$type</td>
              <td>$price</td>
              <td>$sell_method</td>
              <td>$bed_no</td>
              <td>$bath_no</td>
              <td>$lounge_no</td>
              <td>$garage_no</td>
              <td>$house_size m<sub>2</sub></td>
              <td>$land_size m<sub>2</sub></td>
              <td>$featured_property</td>
          </tr>
          ";
 }
    } else {
        $_SESSION["errorMessage"] = "<div class='error-message'>No listings to show</div>";
        $stmt1->close();
        exit;
    }
$stmt1->close();

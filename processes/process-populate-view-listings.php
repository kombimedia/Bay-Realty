<?php
$populate_view_listings = "";
$stmt = $mysqli->prepare("SELECT properties.listing_id, properties.agents, properties.title, properties.address, properties.categories, properties.type, properties.price, properties.sell_method, properties.bed_no, properties.bath_no, properties.lounge_no, properties.garage_no, properties.house_size, properties.land_size, properties.featured_image, properties.featured_property, categories.cat_id, categories.city, property_type.pt_id, property_type.type, agents.agent_id, agents.first_name, agents.surname FROM properties INNER JOIN categories ON properties.categories = categories.cat_id INNER JOIN property_type ON properties.type = property_type.pt_id INNER JOIN agents ON properties.agents = agents.agent_id");
$stmt->execute();
$result = $stmt->get_result();
// Check if there are any records to show
if($result->num_rows > 0) {
  // Loop through data and save each row array to a variable
  while($row = $result->fetch_assoc()) {

      // Convert decimal from DB to currency to display on the page
      $number = $row['price'];
      setlocale(LC_MONETARY,"en_NZ");
      $row['price'] = money_format("%.0n", $number);
      // Check that check box returns 1 or null. We needed to display null as No and 1 as Yes
      if ($row['featured_property'] === 1) {
          $row['featured_property'] = "Yes";
        } else {
          $row['featured_property'] = "No";
        }

// Category, property type and agent are stored in the properties table as their ID. To convert this id to the string value we needed compare the Id to the corresponding table (categories, property_type and agents) then output the matching value string e.g Cy Messenger instead of 1

    // define output field to compare against
    $cat_id = $row['cat_id'];
    // define field to output to listings table
    $city = $row['city'];
    // compare stored data to categories table and save ID as string value
    if ($row['categories'] == $cat_id) {
        $row['categories'] = $city;
      }

    // define output field to compare against
    $pt_id = $row['pt_id'];
    // define field to output to listings table
    $property_type = $row['type'];
    // compare stored data to property_type table and save ID as string value
    if ($row['type'] == $pt_id) {
        $row['type'] = $property_type;
      }

    // define output field to compare against
    $agent_id = $row['agent_id'];
    // define field to output to listings table
    $name = $row['first_name'] . " " . $row['surname'];
    // compare stored data to agents table and save ID as string value
    if ($row['agents'] == $agent_id) {
        $row['agents'] = $name;
      }

$populate_view_listings = $populate_view_listings . "
          <tr>
              <td><img width='150' src='images/uploads/$row[featured_image]'></td>
              <td> $row[listing_id]<br> <a class='view-listing-edit' href='dashboard-update-listing.php?listing_id=$row[listing_id]'>Edit</a> <a class='view-listing-delete' href='#' onClick='deletelisting($row[listing_id])'>Delete</a> </td>
              <td>$row[agents]</td>
              <td>$row[title]</td>
              <td>$row[address]</td>
              <td>$row[categories]</td>
              <td>$row[type]</td>
              <td>$row[price]</td>
              <td>$row[sell_method]</td>
              <td>$row[bed_no]</td>
              <td>$row[bath_no]</td>
              <td>$row[lounge_no]</td>
              <td>$row[garage_no]</td>
              <td>$row[house_size] m<sub>2</sub></td>
              <td>$row[land_size] m<sub>2</sub></td>
              <td>$row[featured_property]</td>
          </tr>
          ";
 }
    } else {
        $_SESSION["errorMessage"] = "<div class='error-message'>No listings to show</div>";
        $stmt->close();
        exit;
    }
$stmt->close();














// $populate_view_listings = "";
// $stmt1 = $mysqli->prepare("SELECT listing_id, agents, title, address, categories, type, price, sell_method, bed_no, bath_no, lounge_no, garage_no, house_size, land_size, featured_image, featured_property FROM properties");
// $stmt1->execute();
// $result1 = $stmt1->get_result();
// // Check if there are any records to show
// if($result1->num_rows > 0) {
//   // Loop through data and save each row array to a variable
//   while($row1 = $result1->fetch_assoc()) {
//       $listing_id = $row1['listing_id'];
//       $agents = $row1['agents'];
//       $title = $row1['title'];
//       $address = $row1['address'];
//       $categories = $row1['categories'];
//       $type = $row1['type'];
//       $price = $row1['price'];
//       $sell_method = $row1['sell_method'];
//       $bed_no = $row1['bed_no'];
//       $bath_no = $row1['bath_no'];
//       $lounge_no = $row1['lounge_no'];
//       $garage_no = $row1['garage_no'];
//       $house_size = $row1['house_size'];
//       $land_size = $row1['land_size'];
//       $featured_image = $row1['featured_image'];
//       $featured_property = $row1['featured_property'];
//       // Convert decimal from DB to currency to display on the page
//       $number = $price;
//       setlocale(LC_MONETARY,"en_NZ");
//       $price = money_format("%.0n", $number);
//       // Check that check box returns 1 or null. We needed to display null as No and 1 as Yes
//       if ($featured_property === 1) {
//           $featured_property = "Yes";
//         } else {
//           $featured_property = "No";
//         }

// // Category, property type and agent are stored in the properties table as their ID. To convert this id to the string value we needed to loop through and compare the Id to the corresponding table (categories, property_type and agents) then output the matching value string e.g Cy Messenger instead of 1
// $stmt = $mysqli->prepare("SELECT cat_id, city FROM categories");
// $stmt->execute();
// $result = $stmt->get_result();
// // Loop through data and output each row
// if($result->num_rows > 0) {
//   while($row = $result->fetch_assoc()) {
//     // define output field to compare against
//     $cat_id = $row['cat_id'];
//     // define field to output to listings table
//     $city = $row['city'];
//     // compare stored data to categories table and save ID as string value
//     if ($categories == $cat_id) {
//         $categories = $city;
//       }
//    }
// }
// $stmt->close();

// $stmt = $mysqli->prepare("SELECT pt_id, type FROM property_type");
// $stmt->execute();
// $result = $stmt->get_result();
// if($result->num_rows > 0) {
//   // Loop through data and output each row
//   while($row = $result->fetch_assoc()) {
//     // define output field to compare against
//     $pt_id = $row['pt_id'];
//     // define field to output to listings table
//     $property_type = $row['type'];
//     // compare stored data to property_type table and save ID as string value
//     if ($type == $pt_id) {
//         $type = $property_type;
//       }
//    }
// }
// $stmt->close();

// $stmt = $mysqli->prepare("SELECT agent_id, first_name, surname FROM agents");
// $stmt->execute();
// $result = $stmt->get_result();
// if($result->num_rows > 0) {
//   // Loop through data and output each row
//   while($row = $result->fetch_assoc()) {
//     // define output field to compare against
//     $agent_id = $row['agent_id'];
//     // define field to output to listings table
//     $name = $row['first_name'] . " " . $row['surname'];
//     // compare stored data to agents table and save ID as string value
//     if ($agents == $agent_id) {
//         $agents = $name;
//       }
//    }
// }
// $stmt->close();

// $populate_view_listings = $populate_view_listings . "
//           <tr>
//               <td><img width='150' src='images/uploads/$featured_image'></td>
//               <td> $listing_id<br> <a class='view-listing-edit' href='dashboard-update-listing.php?listing_id=$listing_id'>Edit</a> <a class='view-listing-delete' href='#' onClick='deletelisting($listing_id)'>Delete</a> </td>
//               <td>$agents</td>
//               <td>$title</td>
//               <td>$address</td>
//               <td>$categories</td>
//               <td>$type</td>
//               <td>$price</td>
//               <td>$sell_method</td>
//               <td>$bed_no</td>
//               <td>$bath_no</td>
//               <td>$lounge_no</td>
//               <td>$garage_no</td>
//               <td>$house_size m<sub>2</sub></td>
//               <td>$land_size m<sub>2</sub></td>
//               <td>$featured_property</td>
//           </tr>
//           ";
//  }
//     } else {
//         $_SESSION["errorMessage"] = "<div class='error-message'>No listings to show</div>";
//         $stmt1->close();
//         exit;
//     }
// $stmt1->close();

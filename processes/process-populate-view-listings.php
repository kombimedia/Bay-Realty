<?php

$getData = "SELECT listing_id, agents, title, address, categories, type, price, sell_method, bed_no, bath_no, lounge_no, garage_no, house_size, land_size, featured_image, featured_property
             FROM properties";
    $result = $mysqli->query($getData);
    // Check if there are any records to show
    if ($result->num_rows > 0) {
        // Loop through data and output each row
        while($row = $result->fetch_assoc()) {
          $listing_id = $row['listing_id'];
          $agents = $row['agents'];
          $title = $row['title'];
          $address = $row['address'];
          $categories = $row['categories'];
          $type = $row['type'];
          $price = $row['price'];
          $sell_method = $row['sell_method'];
          $bed_no = $row['bed_no'];
          $bath_no = $row['bath_no'];
          $lounge_no = $row['lounge_no'];
          $garage_no = $row['garage_no'];
          $house_size = $row['house_size'];
          $land_size = $row['land_size'];
          $featured_property = $row['featured_property'];
          // Check box returns 0 or 1. We needed to display 0 as No and 1 as Yes using a switch statement
          switch ($featured_property) {
              case "0":
                $featured_property = "No";
                break;
              case "1":
                $featured_property = "Yes";
                break;
          }
// Category, property type and agent are stored in the properties table as their ID. To convert this id to the string value we needed to loop through and compare the Id to the corresponding table (categories, property_type and agents) then output the matching value string e.g Cy Messenger instead of 00001
          $getData1 = "SELECT *
                       FROM categories";
          $result1 = $mysqli->query($getData1);
              // Loop through data and output each row
              while($row1 = $result1->fetch_array()) {
                  // define output field to compare against
                  $cat_id = $row1['cat_id'];
                  // define field to output to listings table
                  $city = $row1['city'];
                  // compare stored data to categories table and save ID as string value
                  if ($categories == $cat_id) {
                      $categories = $city;
                  }
              }

          $getData2 = "SELECT *
                       FROM property_type";
          $result2 = $mysqli->query($getData2);
              // Loop through data and output each row
              while($row2 = $result2->fetch_array()) {
                   // define output field to compare against
                  $pt_id = $row2['pt_id'];
                  // define field to output to listings table
                  $property_type = $row2['type'];
                  // compare stored data to property_type table and save ID as string value
                  if ($type == $pt_id) {
                      $type = $property_type;
                    }
                }

          $getData3 = "SELECT agent_id, first_name, surname
                       FROM agents";
          $result3 = $mysqli->query($getData3);
              // Loop through data and output each row
              while($row3 = $result3->fetch_array()) {
                  // define output field to compare against
                  $agent_id = $row3['agent_id'];
                  // define field to output to listings table
                  $name = $row3['first_name'] . " " . $row3['surname'];
                  // compare stored data to agents table and save ID as string value
                  if ($agents == $agent_id) {
                      $agents = $name;
                    }
                }
    }
      } else {
          echo "No property listings to show";
      }
?>

<?php
$listing_id = $_GET['listing_id'];
$_SESSION["update_listing_id"] = $listing_id;
$getData = "SELECT agents, title, address, categories, type, price, sell_method, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_image, featured_property
            FROM properties
            WHERE listing_id = $listing_id";
$result = $mysqli->query($getData);
  // Check if there are any records to show
  if ($result->num_rows > 0) {
    // Loop through data and output each row
    while($row = $result->fetch_assoc()) {
      // Define input variables
      $listing_title = $row['title'];
      $address = $row['address'];
      $price = $row['price'];
      $sell_method = $row['sell_method'];
      $bed_des = $row['bed_des'];
      $bath_des = $row['bath_des'];
      $lounge_des = $row['lounge_des'];
      $garage_des = $row['garage_des'];
      $house_size = $row['house_size'];
      $land_size = $row['land_size'];
      $map_co_ords = $row['map_co_ords'];
      $featured_image = $row['featured_image'];
      $featured_property = $row['featured_property'];

        // Get data for the 'select lists' to dynamically build each list with the saved option preselected
        $options_agents = "";
        $getData1 = "SELECT agent_id, first_name, surname
                     FROM agents";
          $result1 = $mysqli->query($getData1);
              // Loop through data and output each row
              while($row1 = $result1->fetch_array()) {
                  $agent_name = $row1['first_name'] . " " . $row1['surname'];
                  // compare the stored value from the properties table to that of the agents table. If there is a match add the 'selected' tag to that option
                  if ($row['agents'] == $row1['agent_id']) {
                      $options_agents = $options_agents . "<option selected value='$row1[agent_id]'>$agent_name</option>";
                        // if the stored value does not match the value in the agents table create an option with no 'selected' tag
                        } else {
                          $options_agents = $options_agents . "<option value='$row1[agent_id]'>$agent_name</option>";
                          }
                    }

        $options_city = "";
        $getData2 = "SELECT *
                     FROM categories";
          $result2 = $mysqli->query($getData2);
              // Loop through data and output each row
              while($row2 = $result2->fetch_array()) {
                  // compare the stored value from the properties table to that of the categories table. If there is a match add the 'selected' tag to that option
                  if ($row['categories'] == $row2['cat_id']) {
                      $options_city = $options_city . "<option selected value='$row2[cat_id]'>$row2[city]</option>";
                        // if the stored value does not match the value in the categories table create an option with no 'selected' tag
                        } else {
                          $options_city = $options_city . "<option value='$row2[cat_id]'>$row2[city]</option>";
                          }
                    }

        $options_type = "";
        $getData3 = "SELECT *
                     FROM property_type";
          $result3 = $mysqli->query($getData3);
              // Loop through data and output each row
              while($row3 = $result3->fetch_array()) {
                  // compare the stored value from the properties table to that of the type table. If there is a match add the 'selected' tag to that option
                  if ($row['type'] == $row3['pt_id']) {
                      $options_type = $options_type . "<option selected value='$row3[pt_id]'>$row3[type]</option>";
                        // if the stored value does not match the value in the type table create an option with no 'selected' tag
                        } else {
                          $options_type = $options_type . "<option value='$row3[pt_id]'>$row3[type]</option>";
                          }
                    }

        $options_beds = "";
        for($i = 0; $i <= 5; $i++) {
            if ($row['bed_no'] == $i) {
                $options_beds = $options_beds . "<option selected value='$row[bed_no]'>$row[bed_no]</option>";
                  // if the stored value does not match the value in the type table create an option with no 'selected' tag
                  } elseif ($i == 5) {
                      $options_beds = $options_beds . "<option value='$i'>$i +</option>";
                      } else {
                        $options_beds = $options_beds . "<option value='$i'>$i</option>";
                      }
                }

        $options_bath = "";
        for($i = 0; $i <= 5; $i++) {
            if ($row['bath_no'] == $i) {
                $options_bath = $options_bath . "<option selected value='$row[bath_no]'>$row[bath_no]</option>";
                  // if the stored value does not match the value in the type table create an option with no 'selected' tag
                   } elseif ($i == 5) {
                      $options_bath = $options_bath . "<option value='$i'>$i +</option>";
                      }
                       else {
                            $options_bath = $options_bath . "<option value='$i'>$i</option>";
                      }
                }

       $options_lounge = "";
        for($i = 0; $i <= 3; $i++) {
            if ($row['lounge_no'] == $i) {
                $options_lounge = $options_lounge . "<option selected value='$row[lounge_no]'>$row[lounge_no]</option>";
                  // if the stored value does not match the value in the type table create an option with no 'selected' tag
                  } elseif ($i == 3) {
                      $options_lounge = $options_lounge . "<option value='$i'>$i +</option>";
                      } else {
                        $options_lounge = $options_lounge . "<option value='$i'>$i</option>";
                      }
                }

        $options_garage = "";
          for($i = 0; $i <= 3; $i++) {
              if ($row['garage_no'] == $i) {
                  $options_garage = $options_garage . "<option selected value='$row[garage_no]'>$row[garage_no]</option>";
                    // if the stored value does not match the value in the type table create an option with no 'selected' tag
                   } elseif ($i == 3) {
                      $options_garage = $options_garage . "<option value='$i'>$i +</option>";
                      } else {
                        $options_garage = $options_garage . "<option value='$i'>$i</option>";
                      }
                }

        $radio_featured_image = "";
        $getData4 = "SELECT image_id, img_name
                    FROM images
                    WHERE listing_id = $listing_id";
            $result4 = $mysqli->query($getData4);
            // Check if there are any records to show
            if ($result4->num_rows > 0) {
                // Loop through data and output each row
                 while($row4 = $result4->fetch_assoc()) {
                    if ($row4['img_name'] == $featured_image) {
                        $radio_featured_image = $radio_featured_image .
                        "<label class='custom-control custom-radio'>
                        <input id='$row4[image_id]' name='updateFImage' type='radio' class='custom-control-input' checked='checked' value='$row4[img_name]'>
                        <span class='custom-control-indicator'></span>
                        <span class='custom-control-description'><img class='img-fluid' src='images/uploads/$row4[img_name]' width='300'></span>
                        </label>";
                    } else {
                        $radio_featured_image = $radio_featured_image .
                        "<label class='custom-control custom-radio'>
                        <input id='$row4[image_id]' name='updateFImage' type='radio' class='custom-control-input' value='$row4[img_name]'>
                        <span class='custom-control-indicator'></span>
                        <span class='custom-control-description'><img class='img-fluid' src='images/uploads/$row4[img_name]' width='300'></span>
                        </label>";
                    }
                 }
              } else {
                  echo "No images listings to show";
              }


    }
  }
?>

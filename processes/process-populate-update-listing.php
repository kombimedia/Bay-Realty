<?php
$listing_id = $_GET['listing_id'];
$_SESSION["update_listing_id"] = $listing_id;

$stmt = $mysqli->prepare("SELECT agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_image, featured_property FROM properties WHERE listing_id = ?");
$stmt->bind_param("i", $listing_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $agents = $row['agents'];
      $listing_title = $row['title'];
      $address = $row['address'];
      $categories = $row['categories'];
      $type = $row['type'];
      $price = $row['price'];
      $sell_method = $row['sell_method'];
      $prop_des = $row['property_des'];
      $bed_no = $row['bed_no'];
      $bed_des = $row['bed_des'];
      $bath_no = $row['bath_no'];
      $bath_des = $row['bath_des'];
      $lounge_no = $row['lounge_no'];
      $lounge_des = $row['lounge_des'];
      $garage_no = $row['garage_no'];
      $garage_des = $row['garage_des'];
      $house_size = $row['house_size'];
      $land_size = $row['land_size'];
      $map_co_ords = $row['map_co_ords'];
      $featured_image = $row['featured_image'];
      $featured_property = $row['featured_property'];
    }
} else {
      // If there is no data to be displayed throw an error message
      $_SESSION["propertiesErrorMessage"] = "<div class='error-message'>Ahhhh... It appears most of the form fields are empty. That's annoying! You should maybe contact the website administrator and get that fixed.</div>";
      }
$stmt->close();

// Get data for the 'select lists' to dynamically build each list with the saved option preselected
$options_agents = "";
$stmt = $mysqli->prepare("SELECT agent_id, first_name, surname FROM agents");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    // Loop through data and output each row
    while($row1 = $result->fetch_assoc()) {
        $arr[] = row1;
        $agent_name = $row1['first_name'] . " " . $row1['surname'];
          // compare the stored value from the properties table to that of the agents table. If there is a match add the 'selected' tag to that option
        if ($agents == $row1['agent_id']) {
            $options_agents = $options_agents . "<option selected value='$row1[agent_id]'>$agent_name</option>";
              // if the stored value does not match the value in the agents table create an option with no 'selected' tag
            } else {
              $options_agents = $options_agents . "<option value='$row1[agent_id]'>$agent_name</option>";
              }
      }
} else {
      // If there is no data to be displayed throw an error message
      $_SESSION["agentsErrorMessage"] = "<div class='error-message'>Hmmmm... For some reason the correct Agent's name hasn't been selected. That's annoying! You should maybe contact the website administrator and get that fixed.</div>";
      }
$stmt->close();

$options_city = "";
$stmt = $mysqli->prepare("SELECT cat_id, city FROM categories");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    // Loop through data and output each row
    while($row2 = $result->fetch_assoc()) {
      $arr[] = $row2;
      // compare the stored value from the properties table to that of the categories table. If there is a match add the 'selected' tag to that option
      if ($categories == $row2['cat_id']) {
            $options_city = $options_city . "<option selected value='$row2[cat_id]'>$row2[city]</option>";
            // if the stored value does not match the value in the categories table create an option with no 'selected' tag
            } else {
              $options_city = $options_city . "<option value='$row2[cat_id]'>$row2[city]</option>";
              }
      }
} else {
      // If there is no data to be displayed throw an error message
      $_SESSION["categoriesErrorMessage"] = "<div class='error-message'>Hmmmm... For some reason the correct City hasn't been selected. That's annoying! You should maybe contact the website administrator and get that fixed.</div>";
      }
$stmt->close();

$options_type = "";
$stmt = $mysqli->prepare("SELECT pt_id, type FROM property_type");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    // Loop through data and output each row
    while($row3 = $result->fetch_assoc()) {
      $arr[] = $row3;
      // compare the stored value from the properties table to that of the type table. If there is a match add the 'selected' tag to that option
      if ($type == $row3['pt_id']) {
          $options_type = $options_type . "<option selected value='$row3[pt_id]'>$row3[type]</option>";
            // if the stored value does not match the value in the type table create an option with no 'selected' tag
            } else {
              $options_type = $options_type . "<option value='$row3[pt_id]'>$row3[type]</option>";
              }
        }
} else {
      // If there is no data to be displayed throw an error message
      $_SESSION["typeErrorMessage"] = "<div class='error-message'>Hmmmm... For some reason the correct Property Type hasn't been selected. That's annoying! You should maybe contact the website administrator and get that fixed.</div>";
      }
$stmt->close();

$options_beds = "";
for($i = 0; $i <= 5; $i++) {
    if ($bed_no == $i) {
        $options_beds = $options_beds . "<option selected value='$bed_no'>$bed_no</option>";
          // if the stored value does not match the value in the type table create an option with no 'selected' tag
          } elseif ($i == 5) {
              $options_beds = $options_beds . "<option value='$i'>$i +</option>";
              } else {
                $options_beds = $options_beds . "<option value='$i'>$i</option>";
              }
        }

$options_bath = "";
for($i = 0; $i <= 5; $i++) {
    if ($bath_no == $i) {
        $options_bath = $options_bath . "<option selected value='$bath_no'>$bath_no</option>";
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
    if ($lounge_no == $i) {
        $options_lounge = $options_lounge . "<option selected value='$lounge_no'>$lounge_no</option>";
          // if the stored value does not match the value in the type table create an option with no 'selected' tag
          } elseif ($i == 3) {
              $options_lounge = $options_lounge . "<option value='$i'>$i +</option>";
              } else {
                $options_lounge = $options_lounge . "<option value='$i'>$i</option>";
              }
        }

$options_garage = "";
  for($i = 0; $i <= 3; $i++) {
      if ($garage_no == $i) {
          $options_garage = $options_garage . "<option selected value='$garage_no'>$garage_no</option>";
            // if the stored value does not match the value in the type table create an option with no 'selected' tag
           } elseif ($i == 3) {
              $options_garage = $options_garage . "<option value='$i'>$i +</option>";
              } else {
                $options_garage = $options_garage . "<option value='$i'>$i</option>";
              }
        }
//Change featured image
$radio_featured_image = "";
$stmt = $mysqli->prepare("SELECT image_id, img_name FROM images WHERE listing_id = ?");
$stmt->bind_param("i", $listing_id);
$stmt->execute();
$result = $stmt->get_result();
// Check if there are any records to show
if ($result->num_rows > 0) {
    // Loop through data and output each row
    while ($row4 = $result->fetch_assoc()) {
        $arr[] = $row4;
        // Check to see which image is currently the featured image and 'check' this radio - current featured image will be preselected
        if ($row4['img_name'] == $featured_image) {
            // Build radio list populated with listing's images
            $radio_featured_image = $radio_featured_image .
            "<label class='custom-control custom-radio'>
            <input id='$row4[image_id]' name='updateFImage' type='radio' class='custom-control-input' checked='checked' value='$row4[img_name]'>
            <span class='custom-control-indicator'></span>
            <span class='custom-control-description'><img class='img-fluid' src='images/uploads/$row4[img_name]' width='300'></span>
            </label>";
        } else {
            // Radio's will be built with all other images
            $radio_featured_image = $radio_featured_image .
            "<label class='custom-control custom-radio'>
            <input id='$row4[image_id]' name='updateFImage' type='radio' class='custom-control-input' value='$row4[img_name]'>
            <span class='custom-control-indicator'></span>
            <span class='custom-control-description'><img class='img-fluid' src='images/uploads/$row4[img_name]' width='300'></span>
            </label>";
        }
    }
} else {
      // If there is no data to be displayed throw an error message
      $_SESSION["featuredImErrorMessage"] = "<div class='error-message'>Hmmmm... For some reason the Featured Image isn't showing. That's annoying! You should maybe contact the website administrator and get that fixed.</div>";
      }
$stmt->close();
exit;

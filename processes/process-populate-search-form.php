<?php
$option_city = "";
$stmt = $mysqli->prepare("SELECT cat_id, city FROM categories");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($city = $result->fetch_assoc()) {
      $arr[] = $city;
      // for each value found, create an 'option' for the select list
      $option_city = $option_city . "<option value='$city[cat_id]'>$city[city]</option>";
      }
  } else {
    $_SESSION["dbError"] = "<div class='error-message'>Error setting up 'City' select options. Please contact website administrator</div>";
  }
  $stmt->close();

  $option_type = "";
$stmt = $mysqli->prepare("SELECT pt_id, type FROM property_type");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($type = $result->fetch_assoc()) {
      $arr[] = $type;
      // for each value found, create an 'option' for the select list
      $option_type = $option_type . "<option value='$type[pt_id]'>$type[type]</option>";
      }
  } else {
    $_SESSION["dbError"] = "<div class='error-message'>Error setting up 'Property Type' select options. Please contact website administrator</div>";
  }
  $stmt->close();

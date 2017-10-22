<?php
$option_agents = "";
$stmt = $mysqli->prepare("SELECT agent_id, first_name, surname FROM agents");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($agents = $result->fetch_assoc()) {
      $arr[] = $agents;
      $agent_name = $agents['first_name'] . " " . $agents['surname'];
      // for each value found, create an 'option' for the select list
      $option_agents = $option_agents . "<option value='$agents[agent_id]'>$agent_name</option>";
      }
  } else {
    $_SESSION["dbError"] = "<div class='error-message'>Error setting up 'Agents' select options. Please contact website administrator</div>";
  }
  $stmt->close();

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

$option_beds = "";
for($i = 1; $i <= 5; $i++) {
    if ($i == 5) {
      $option_beds = $option_beds . "<option value='$i'>$i +</option>";
      } else {
        $option_beds = $option_beds . "<option value='$i'>$i</option>";
      }
}

$option_bath = "";
for($i = 1; $i <= 5; $i++) {
    if ($i == 5) {
      $option_bath = $option_bath . "<option value='$i'>$i +</option>";
      } else {
        $option_bath = $option_bath . "<option value='$i'>$i</option>";
      }
}

$option_lounge = "";
for($i = 1; $i <= 3; $i++) {
    if ($i == 3) {
      $option_lounge = $option_lounge . "<option value='$i'>$i +</option>";
      } else {
        $option_lounge = $option_lounge . "<option value='$i'>$i</option>";
      }
}

$option_garage = "";
  for($i = 1; $i <= 3; $i++) {
    if ($i == 3) {
      $option_garage = $option_garage . "<option value='$i'>$i +</option>";
      } else {
        $option_garage = $option_garage . "<option value='$i'>$i</option>";
      }
}

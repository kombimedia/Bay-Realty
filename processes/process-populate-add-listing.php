<?php
$option_agents = "";
$stmt = $mysqli->prepare("SELECT agent_id, first_name, surname FROM agents");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($agents = $result->fetch_assoc()) {
      $agent_name = $agents['first_name'] . " " . $agents['surname'];
      // for each value found, create an 'option' for the select list
      //$option_agents = $option_agents . "<option value='$agents[agent_id]'>$agent_name</option>";
      // Check whether an option has been selected and compare it to the db
      if (isset($_SESSION['storeAgent']) && $agents['agent_id'] == $_SESSION['storeAgent']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_agents = $option_agents . "<option selected value='$agents[agent_id]'>$agent_name</option>";
          unset($_SESSION['storeAgent']);
      } else {
          // If no option is selected build list
          $option_agents = $option_agents . "<option value='$agents[agent_id]'>$agent_name</option>";
        }
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
      // for each value found, create an 'option' for the select list
      //$option_city = $option_city . "<option value='$city[cat_id]'>$city[city]</option>";
      // Check whether an option has been selected and compare it to the db
      if (isset($_SESSION['storeCity']) && $city['cat_id'] == $_SESSION['storeCity']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_city = $option_city . "<option selected value='$city[cat_id]'>$city[city]</option>";
          unset($_SESSION['storeCity']);
      } else {
          // If no option is selected build list
          $option_city = $option_city . "<option value='$city[cat_id]'>$city[city]</option>";
        }
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
      // for each value found, create an 'option' for the select list
      //$option_type = $option_type . "<option value='$type[pt_id]'>$type[type]</option>";
      // Check whether an option has been selected and compare it to the db
      if (isset($_SESSION['storeType']) && $type['pt_id'] == $_SESSION['storeType']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_type = $option_type . "<option selected value='$type[pt_id]'>$type[type]</option>";
          unset($_SESSION['storeType']);
      } else {
          // If no option is selected build list
          $option_type = $option_type . "<option value='$type[pt_id]'>$type[type]</option>";
        }
    }
  } else {
    $_SESSION["dbError"] = "<div class='error-message'>Error setting up 'Property Type' select options. Please contact website administrator</div>";
  }
  $stmt->close();

$option_beds = "";
for($i = 1; $i <= 5; $i++) {
    // Add a + to the end of the last option
    if ($i == 5) {
      // Check whether an option has been selected and compare it to the loop
      if (isset($_SESSION['storeBeds']) && $i == $_SESSION['storeBeds']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_beds = $option_beds . "<option selected value='$i'>$i +</option>";
          unset($_SESSION['storeBeds']);
      } else {
          // If no option is selected build list
          $option_beds = $option_beds . "<option value='$i'>$i +</option>";
        }
    } else {
      if (isset($_SESSION['storeBeds']) && $i == $_SESSION['storeBeds']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_beds = $option_beds . "<option selected value='$i'>$i</option>";
          unset($_SESSION['storeBeds']);
      } else {
          // If no option is selected build list
          $option_beds = $option_beds . "<option value='$i'>$i</option>";
        }
    }
}

$option_bath = "";
for($i = 1; $i <= 5; $i++) {
    // Add a + to the end of the last option
    if ($i == 5) {
      // Check whether an option has been selected and compare it to the loop
      if (isset($_SESSION['storeBath']) && $i == $_SESSION['storeBath']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_bath = $option_bath . "<option selected value='$i'>$i +</option>";
          unset($_SESSION['storeBath']);
      } else {
          // If no option is selected build list
          $option_bath = $option_bath . "<option value='$i'>$i +</option>";
        }
    } else {
      if (isset($_SESSION['storeBath']) && $i == $_SESSION['storeBath']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_bath = $option_bath . "<option selected value='$i'>$i</option>";
          unset($_SESSION['storeBath']);
      } else {
          // If no option is selected build list
          $option_bath = $option_bath . "<option value='$i'>$i</option>";
        }
    }
}

$option_lounge = "";
for($i = 1; $i <= 3; $i++) {
    // Add a + to the end of the last option
    if ($i == 3) {
      // Check whether an option has been selected and compare it to the loop
      if (isset($_SESSION['storeLounge']) && $i == $_SESSION['storeLounge']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_lounge = $option_lounge . "<option selected value='$i'>$i +</option>";
          unset($_SESSION['storeLounge']);
      } else {
          // If no option is selected build list
          $option_lounge = $option_lounge . "<option value='$i'>$i +</option>";
        }
    } else {
      if (isset($_SESSION['storeLounge']) && $i == $_SESSION['storeLounge']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_lounge = $option_lounge . "<option selected value='$i'>$i</option>";
          unset($_SESSION['storeLounge']);
      } else {
          // If no option is selected build list
          $option_lounge = $option_lounge . "<option value='$i'>$i</option>";
        }
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

$option_garage = "";
for($i = 1; $i <= 3; $i++) {
    // Add a + to the end of the last option
    if ($i == 3) {
      // Check whether an option has been selected and compare it to the loop
      if (isset($_SESSION['storeGarage']) && $i == $_SESSION['storeGarage']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_garage = $option_garage . "<option selected value='$i'>$i +</option>";
          unset($_SESSION['storeGarage']);
      } else {
          // If no option is selected build list
          $option_garage = $option_garage . "<option value='$i'>$i +</option>";
        }
  } else {
      if (isset($_SESSION['storeGarage']) && $i == $_SESSION['storeGarage']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_garage = $option_garage . "<option selected value='$i'>$i</option>";
          unset($_SESSION['storeGarage']);
      } else {
          // If no option is selected build list
          $option_garage = $option_garage . "<option value='$i'>$i</option>";
        }
    }
}

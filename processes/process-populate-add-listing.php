<?php>
$option_agents = "";
$getData = "SELECT *
            FROM agents";
    $result = $mysqli->query($getData);
        // Loop through data and output data array
        while($agents = $result->fetch_array()) {
            $agent_name = $agents['first_name'] . " " . $agents['surname'];
            // for each value found, create an 'option' for the select list
            $option_agents = $option_agents . "<option value='$agents[agent_id]'>$agent_name</option>";
        }

$option_city = "";
$getData1 = "SELECT *
            FROM categories";
    $result1 = $mysqli->query($getData1);
        // Loop through data and output data array
        while($city = $result1->fetch_array()) {
            // for each value found, create an 'option' for the select list
            $option_city = $option_city . "<option value='$city[cat_id]'>$city[city]</option>";
        }

$option_type = "";
$getData2 = "SELECT *
            FROM property_type";
    $result2 = $mysqli->query($getData2);
        // Loop through data and output data array
        while($type = $result2->fetch_array()) {
            // for each value found, create an 'option' for the select list
            $option_type = $option_type . "<option value='$type[pt_id]'>$type[type]</option>";
        }

$option_beds = "";
for($i = 0; $i <= 5; $i++) {
    if ($i == 5) {
      $option_bed = $option_bed . "<option value='$i'>$i +</option>";
      } else {
        $option_bed = $option_bed . "<option value='$i'>$i</option>";
      }
}

$option_bath = "";
for($i = 0; $i <= 5; $i++) {
    if ($i == 5) {
      $option_bath = $option_bath . "<option value='$i'>$i +</option>";
      } else {
        $option_bath = $option_bath . "<option value='$i'>$i</option>";
      }
}

$option_lounge = "";
for($i = 0; $i <= 3; $i++) {
    if ($i == 3) {
      $option_lounge = $option_lounge . "<option value='$i'>$i +</option>";
      } else {
        $option_lounge = $option_lounge . "<option value='$i'>$i</option>";
      }
}

$option_garage = "";
  for($i = 0; $i <= 3; $i++) {
    if ($i == 3) {
      $option_garage = $option_garage . "<option value='$i'>$i +</option>";
      } else {
        $option_garage = $option_garage . "<option value='$i'>$i</option>";
      }
}
?>

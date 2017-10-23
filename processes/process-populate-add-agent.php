<?php
$option_area = "";
$stmt = $mysqli->prepare("SELECT cat_id, city FROM categories");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($row = $result->fetch_assoc()) {
      // for each value found, create an 'option' for the select list
      $option_area = $option_area . "<option value='$row[cat_id]'>$row[city]</option>";
      }
  } else {
    $_SESSION["errorMessage"] = "<div class='error-message'>Error setting up 'Area' select options. Please contact website administrator</div>";
  }
  $stmt->close();

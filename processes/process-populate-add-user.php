<?php
$option_role = "";
$stmt = $mysqli->prepare("SELECT role_id, user_role FROM user_roles");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($row = $result->fetch_assoc()) {
      // for each value found, create an 'option' for the select list
      $option_role = $option_role . "<option value='$row[role_id]'>$row[user_role]</option>";
      }
  } else {
    $_SESSION["dbError"] = "<div class='error-message'>Error setting up 'Roles' select options. Please contact website administrator</div>";
  }
  $stmt->close();

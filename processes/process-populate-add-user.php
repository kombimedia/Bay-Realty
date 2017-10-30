<?php
$option_role = "";
$stmt = $mysqli->prepare("SELECT role_id, user_role FROM user_roles");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($row = $result->fetch_assoc()) {
      // Check whether an option has been selected and compare it to the db
      if (isset($_SESSION['storeRole']) && $row['role_id'] == $_SESSION['storeRole']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_role = $option_role . "<option selected value='$row[role_id]'>$row[user_role]</option>";
          // Clear select option on page refresh
          unset($_SESSION['storeRole']);
      } else {
          // If no option is selected build list
          $option_role = $option_role . "<option value='$row[role_id]'>$row[user_role]</option>";
        }
      }
} else {
    $_SESSION["dbError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
  }
  $stmt->close();

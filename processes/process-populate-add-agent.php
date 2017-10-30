<?php
$option_area = "";
$stmt = $mysqli->prepare("SELECT cat_id, city FROM categories");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($row = $result->fetch_assoc()) {
      // Check whether an option has been selected and compare it to the db
      if (isset($_SESSION['storeArea']) && $row['cat_id'] == $_SESSION['storeArea']) {
          // If an option is selected make this option selected when list is built (used for repopulating select list if validation fails)
          $option_area = $option_area . "<option selected value='$row[cat_id]'>$row[city]</option>";
          // Clear select option on page refresh
          unset($_SESSION['storeArea']);
      } else {
          // If no option is selected build list
          $option_area = $option_area . "<option value='$row[cat_id]'>$row[city]</option>";
        }
      }
  } else {
    $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
  }
  $stmt->close();

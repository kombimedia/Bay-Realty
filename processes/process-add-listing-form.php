<?php
if (isset($_POST['submit'])) {
  require 'process-add-listing.php';
  include 'process-image-upload.php';
  header('location: ../dashboard-add-listing');
}
// else {
//   $_SESSION["dbError"] = "<div class='error-message'>Something went wrong! Please check that all fields have been filled correctly</div>";
// }
?>

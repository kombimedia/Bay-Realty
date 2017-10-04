<?php
if (isset($_POST['submit'])) {
  require 'process-add-listing.php';
  include 'process-image-upload.php';
  header('location: ../dashboard-add-listing');
}
?>

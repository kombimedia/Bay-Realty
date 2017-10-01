<?php
  $title = "View Listings";
  $metaD = "Admin dashboard page, view listings";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>View All Listings</h1>

  <?php
// Define allowed file types
$validextensions = array("jpeg", "jpg", "png");
// Store file extension
$ext = explode('.', basename($_FILES['file']['name'][$i]));//Explode file name from dot(.)
$file_extension = end($ext); //Store extensions in the variable
// File type is valid and that the image is less than 500KB in size
if (($_FILES["file"]["size"][$i] < 500000) // Approx. 500kb files can be uploaded.
&& in_array($file_extension, $validextensions)) {
//PHP Image Uploading Code
}




  ?>




<?php
  include 'includes/dashboard-footer.php';
?>



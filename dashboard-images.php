<?php
session_start();
// Check visitor is logged in. If not redirect to login page
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "Images";
$metaD = "Admin dashboard page, site images";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
include 'processes/process-populate-images.php';
?>
<h1>Images</h1>

<div><?php if (isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; unset($_SESSION['imageError']); }; ?></div>
<div><?php if (isset($_SESSION['imageDelSuccess'])) { echo $_SESSION['imageDelSuccess']; unset($_SESSION['imageDelSuccess']); }; ?></div>
<div><?php if (isset($_SESSION['imageDelError'])) { echo $_SESSION['imageDelError']; unset($_SESSION['imageDelError']); }; ?></div>
<div><?php if (isset($_SESSION["imageDelFileError"])) { echo $_SESSION["imageDelFileError"]; unset($_SESSION["imageDelFileError"]); }; ?></div>

<table class="table table-responsive table-striped table-images">
  <thead class="images-head">
    <tr>
      <th>Image</th>
      <th>Image ID</th>
      <th>Listing ID</th>
      <th>Name</th>
      <th>Size</th>
      <th>Type</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php echo $populate_images ?>
  </tbody>
</table>

<script language="javascript">
  // Delete confirm alert
 function deleteimage(dellimage) {
     if (confirm("Are you sure you want to delete this image?")) {
     window.location.href='processes/process-delete-image.php?del_image=' +dellimage+'';
     return true;
    }
 }
</script>

<?php
include 'includes/dashboard-footer.php';
?>

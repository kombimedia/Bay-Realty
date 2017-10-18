<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "View Users";
$metaD = "Admin dashboard page, view users";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
include 'processes/process-populate-view-users.php';
?>

  <h1>View All Users</h1>
<!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>

<table class="table table-responsive table-striped table-users">
  <thead class="users-head">
    <tr>
      <th>User ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>User Role</th>
    </tr>
  </thead>
  <tbody>
    <?php //echo $populate_images ?>
  </tbody>
</table>

<script language="javascript">
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

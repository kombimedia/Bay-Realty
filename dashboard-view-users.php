<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "View Users";
$metaD = "Admin dashboard page, view users";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
?>

  <h1>View All Users</h1>

<?php
include 'includes/dashboard-footer.php';
?>

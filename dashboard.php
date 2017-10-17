<?php
session_start();
// $_SESSION['logged_in'] = false;
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "Dashboard";
$metaD = "Admin dashboard page";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
?>

<h1>Dashboard</h1>

<?php
include 'includes/dashboard-footer.php';
?>


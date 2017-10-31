<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');

$title = "Bay Realty - Wishlist Page Page";
$metaD = "Wishlist page page";
include 'includes/header.php';
include 'includes/search.php';
include 'processes/process-populate-wishlist.php';
?>

  <div><?php if (isset($_SESSION['wlSuccess'])) { echo $_SESSION['wlSuccess']; unset($_SESSION['wlSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['wlError'])) { echo $_SESSION['wlError']; unset($_SESSION['wlError']); }; ?></div>
	<table>
	<? echo $display_wishlist ?>
 	</table>

<?php
  include 'includes/footer.php';
?>

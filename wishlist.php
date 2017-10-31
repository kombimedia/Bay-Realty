<?php
session_start();
if (!isset($_SESSION['guestUserName'])) {
    header('location: guest-login');
    exit;
}
error_reporting(E_ALL);
ini_set('display_errors', '1');

$title = "Bay Realty - Wishlist Page Page";
$metaD = "Wishlist page page";
include 'includes/header.php';
include 'includes/search.php';
include 'processes/process-populate-wishlist.php';
?>
<div class="container col search-listings-container">
	<h3>My Wishlist</h3>
  <div><?php if (isset($_SESSION['wlSuccess'])) { echo $_SESSION['wlSuccess']; unset($_SESSION['wlSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['wlError'])) { echo $_SESSION['wlError']; unset($_SESSION['wlError']); }; ?></div>
	<table class="table-striped table-responsive search-listings">
	<? echo $display_wishlist ?>
 	</table>
</div>
 	<script language="javascript">
 // Confirm delete alert
 function deleteWishlist(dellwishlist) {
     if (confirm("Are you sure you want to delete this Listing?")) {
     window.location.href='processes/process-delete-wishlist.php?del_wish=' +dellwishlist+'';
     return true;
    }
 }
</script>

<?php
  include 'includes/footer.php';
?>

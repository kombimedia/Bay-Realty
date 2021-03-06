<?php
session_start();
// if not logged in then redirect to guest-login 
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
<div class="container col search-listings-container" id="my_wishlist">
	<h1>My Wishlist</h1>
  <!-- success message that displays if listing successfully added -->
  <div><?php if (isset($_SESSION['wlSuccess'])) { echo $_SESSION['wlSuccess']; unset($_SESSION['wlSuccess']); }; ?></div>
   <!-- Failed message that displays if listing unable to be added -->
  <div><?php if (isset($_SESSION['wlError'])) { echo $_SESSION['wlError']; unset($_SESSION['wlError']); }; ?></div>
  <!-- $display wishlist built in process wishlist page  and displayed here if logged in-->
	<table id="tablelist" class="table-striped table-responsive search-listings">
	<? echo $display_wishlist ?>
 	</table>
</div>
<!-- Javascript function that created popup box to Confirm delete alert  -->
 	<script language="javascript">
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

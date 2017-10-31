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

<div class="container col search-listings-container">
	<h3>My Wishlist</h3>
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

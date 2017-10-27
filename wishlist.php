<?php
$title = "Bay Realty - Wishlist Page Page";
$metaD = "Wishlist page page";
include 'includes/header.php';
include 'includes/search.php';
?>

 
      <div class="welcome ml-auto"><?php if (isset($_SESSION['guestUserName'])) { echo $_SESSION['guestUserName']; }; ?></div>

<?php
  include 'includes/footer.php';
?>

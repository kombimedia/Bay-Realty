<?php
session_start();
$search_output = $_SESSION['search_output'] ;
$title = "Bay Realty - Category Page";
$metaD = "Category page";
include 'includes/header.php';
include 'includes/search.php';
?>

<div class="container col search-listings-container">
  <h4>Search Results </h4><hr>
  <div><?php if (isset($_SESSION['noListings'])) { echo $_SESSION['noListings']; unset($_SESSION['noListings']); }; ?></div>
  <table class="table-striped table-responsive search-listings">
      <?php echo $search_output ?>
  </table>
</div>

<?php
  include 'includes/footer.php';
?>

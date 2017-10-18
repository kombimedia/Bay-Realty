<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "View Listings";
$metaD = "Admin dashboard page, view listings";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
include 'processes/process-populate-view-listings.php';
?>

  <h1>View Listing</h1>

  <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['serverDelError'])) { echo $_SESSION['serverDelError']; unset($_SESSION['serverDelError']); }; ?></div>
  <div><?php if (isset($_SESSION['imgDelError'])) { echo $_SESSION['imgDelError']; unset($_SESSION['imgDelError']); }; ?></div>
  <div><?php if (isset($_SESSION['listDelError'])) { echo $_SESSION['listDelError']; unset($_SESSION['listDelError']); }; ?></div>

  <table class='table table-striped table-responsive view-listings'>
    <thead class='view-listings-head'>
      <tr>
        <th>Featured Image</th>
        <th>Listing No.</th>
        <th>Agent</th>
        <th>Listing Title</th>
        <th>Address</th>
        <th>City</th>
        <th>Type</th>
        <th>Price</th>
        <th>Sell Method</th>
        <th>Bedrooms</th>
        <th>Bathrooms</th>
        <th>Lounges</th>
        <th>Garages</th>
        <th>House Size</th>
        <th>Land Size</th>
        <th>Featured Listing</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $populate_view_listings ?>
    </tbody>
  </table>

<script language="javascript">
 function deletelisting(dellisting) {
     if (confirm("Are you sure you want to delete this listing?")) {
     window.location.href='processes/process-delete-listing.php?del_listing=' +dellisting+'';
     return true;
    }
 }
</script>

<?php
include 'includes/dashboard-footer.php';
?>




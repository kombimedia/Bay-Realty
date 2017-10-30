<?php
session_start();
// Check visitor is logged in. If not redirect to login page
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "Dashboard";
$metaD = "Admin dashboard page";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
include 'processes/process-populate-dashboard-home.php';
?>

<h1>Recent Activity</h1>
<div class="row">
  <div class="col-12">
      <h3>Latest Listings</h3>
      <table class='table table-striped table-responsive view-listings'>
        <thead class='view-listings-head'>
          <tr>
            <th>Featured Image</th>
            <th>Listing No.</th>
            <th>Agent</th>
            <th>Listing Title</th>
            <th>Address</th>
            <th>City</th>
            <th>Price</th>
            <th>Sell Method</th>
          </tr>
        </thead>
        <tbody>
          <?php echo $populate_dashboard_listings ?>
        </tbody>
      </table>
  </div>
  <a class="a-btn mb-5 ml-3" href="/bay-realty/dashboard-view-listings"><button class="btn btn-md btn-block dash-btn">See All Listings</button></a>

  <div class="col-12">
      <h3>Newest Agents</h3>
      <table class='table table-striped table-responsive view-agents'>
          <thead class='agents-head'>
            <tr>
              <th>Agent Image</th>
              <th>Agent ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Area</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $populate_dashboard_agents ?>
          </tbody>
      </table>
  </div>
  <a class="a-btn mb-5 ml-3" href="/bay-realty/dashboard-view-agents"><button class="btn btn-md btn-block dash-btn">See All Agents</button></a>

  <div class="col-12">
      <h3>User Sign Ups</h3>
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
          <?php echo $populate_dashboard_users ?>
        </tbody>
      </table>
  </div>
  <a class="a-btn mb-5 ml-3" href="/bay-realty/dashboard-view-users"><button class="btn btn-md btn-block dash-btn">See All Users</button></a>
</div>
<?php
include 'includes/dashboard-footer.php';
?>


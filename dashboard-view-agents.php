<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "View Agents";
$metaD = "Admin dashboard page, view agents";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
include 'processes/process-populate-view-agents.php';
?>

<h1>View Agents</h1>

<div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
<div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>
<div><?php if (isset($_SESSION['agentDelError'])) { echo $_SESSION['agentDelError']; unset($_SESSION['agentDelError']); }; ?></div>

<table class='table table-striped table-responsive view-agents'>
    <thead class='agents-head'>
      <tr>
        <th>Agent Image</th>
        <th>Agent ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Profile</th>
        <th>Area</th>
      </tr>
    </thead>
    <tbody>
      <?php echo $populate_view_agents ?>
    </tbody>
</table>

<script language="javascript">
 function deleteAgent(delagent) {
     if (confirm("Are you sure you want to delete this Agent?")) {
     window.location.href='processes/process-delete-agent.php?del_agent=' +delagent+'';
     return true;
    }
 }
</script>

<?php
include 'includes/dashboard-footer.php';
?>

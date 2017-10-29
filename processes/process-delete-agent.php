<?php
session_start();
include '../includes/db-connect.php';

// Get user ID
$agent_id = $_GET['del_agent'];

// Delete profile picture from uploads folder
$stmt = $mysqli->prepare("SELECT profile_pic FROM agents WHERE agent_id = ?");
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    // define path to image
    $path = "../images/uploads/" . $row['profile_pic'];
    // Run file delete function, passing the image path
    unlink($path);
  }
} else {
    $_SESSION["serverDelError"] = "<div class='error-message'>No images to delete from the server</div>";
}
$stmt->close();

// Delete User from db
$stmt = $mysqli->prepare("DELETE FROM agents WHERE agent_id = ?");
$stmt->bind_param("i", $agent_id);
if (!$stmt->execute()) {
    $_SESSION["agentDelError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
} else {
    $_SESSION["successMessage"] = "<div class='success-message'>Agent ID: " . $agent_id ." was successfully deleted</div>";
}
$stmt->close();
// Close db connection
$mysqli->close();
// Redirect back to 'view agents' page
header('location: ../dashboard-view-agents');

<?php
session_start();
include '../includes/db-connect.php';

// Get user ID
$agent_id = $_GET['del_agent'];

// Delete User from db
$stmt = $mysqli->prepare("DELETE FROM agents WHERE agent_id = ?");
$stmt->bind_param("i", $agent_id);
if (!$stmt->execute()) {
    $_SESSION["agentDelError"] = "<div class='error-message'>Uh oh.. Agent wasn't deleted. Please contact website administrator.</div>";
} else {
    $_SESSION["successMessage"] = "<div class='success-message'>Agent ID: " . $agent_id ." was successfully deleted</div>";
}
$stmt->close();
$mysqli->close();
header('location: ../dashboard-view-agents');

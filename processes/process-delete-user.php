<?php
session_start();
include '../includes/db-connect.php';

// Get user ID
$user_id = $_GET['del_user'];

// Delete User from db
$stmt = $mysqli->prepare("DELETE FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
if (!$stmt->execute()) {
    $_SESSION["listDelError"] = "<div class='error-message'>Uh oh.. User wasn't deleted. Please contact website administrator.</div>";
} else {
    $_SESSION["successMessage"] = "<div class='success-message'>User ID: " . $user_id ." was successfully deleted</div>";
}
$stmt->close();
$mysqli->close();
header('location: ../dashboard-view-users');

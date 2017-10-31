<?php

session_start();
include '../includes/db-connect.php';

$listing_id = $_GET['del_wish'];
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['guestUserName'])) {

    $stmt = $mysqli->prepare("DELETE FROM wishlist WHERE listing_id = ?");
$stmt->bind_param("i", $listing_id);
     $stmt->execute();
 
 if (!$stmt->execute()) {
    $_SESSION["listDelError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
} else {
    $_SESSION["successMessage"] = "<div class='success-message'>User ID: " . $listing_id ." was successfully deleted</div>";
}
}
$stmt->close();



// Remove from array

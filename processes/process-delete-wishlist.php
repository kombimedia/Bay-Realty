<?php

session_start();
include '../includes/db-connect.php';
//  Get listing id
$listing_id = $_GET['del_wish'];
// Get user id
$user_id = $_SESSION['user_id'];
// Delete wishlist from database
    $stmt = $mysqli->prepare("DELETE FROM wishlist WHERE listing_id = ? AND user_id = ?");
$stmt->bind_param("ii", $listing_id, $user_id);
 if (!$stmt->execute()) {
    $_SESSION["wlError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
    header('location: ../wishlist');
    exit;
} else {
     $_SESSION['wlSuccess'] = "Listing with ID: " . $listing_id . " was successfully removed from your wishlist ";
        header('location: ../wishlist#my_wishlist');
}

// close db connection
$stmt->close();





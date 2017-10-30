<?php
session_start();
include '../includes/db-connect.php';

// Get listing ID
$listing_id = $_GET['del_listing'];
// Delete images from uploads folder
$stmt = $mysqli->prepare("SELECT img_name FROM images WHERE listing_id = ?");
$stmt->bind_param("i", $listing_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    // Define path to image(s)
    $path = "../images/uploads/" . $row['img_name'];
    // Run file delete function, passing path to image(s)
    unlink($path);
  }
} else {
    $_SESSION["serverDelError"] = "<div class='error-message'>No images to delete from the server</div>";
}
$stmt->close();

// Delete images from db
$stmt = $mysqli->prepare("DELETE FROM images WHERE listing_id = ?");
$stmt->bind_param("i", $listing_id);
if (!$stmt->execute()) {
    $_SESSION["imgDelError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
}
$stmt->close();

// Delete listing from db
$stmt = $mysqli->prepare("DELETE FROM properties WHERE listing_id = ?");
$stmt->bind_param("i", $listing_id);
if (!$stmt->execute()) {
    $_SESSION["listDelError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
} else {
    $_SESSION["successMessage"] = "<div class='success-message'>Listing ID: " . $listing_id ." was successfully deleted</div>";
}
$stmt->close();
// Close db connection
$mysqli->close();
header('location: ../dashboard-view-listings');


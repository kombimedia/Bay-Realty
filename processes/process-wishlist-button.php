<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['guestUserName'])) {
    header('location: ../guest-login');
    exit;
}

include "../includes/db-connect.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
// listing id has been sent to url to be fetched by _Get to compare listing id in db when inserting wishlist
$listing_id = $_GET['listing_id'];
// user id session created when logging in to compare to user id in the db
$user_id = $_SESSION['user_id'];
$ws_listing_id = true;

// 
$stmt = $mysqli->prepare("SELECT user_id, listing_id FROM wishlist WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  	//  if listing id is not = to listing id in database then set to true
      if ($listing_id != $row['listing_id']) {
          $ws_listing_id = true;
      } else {
      	// else set to false
        $ws_listing_id = false;

        // if there is already a listing added by the user then fire of this error message
        
        $_SESSION['wlError'] = "Listing with ID: " . $listing_id . " is already saved to your wishlist";
        header('location: ../wishlist#my_wishlist');
        exit;
      }
  }
}
$stmt->close();
//  if there is no listing id saved to database that matches the listing id that has just been clicked then insert into wilshlist table
if ($ws_listing_id) {
    $stmt = $mysqli->prepare("INSERT INTO wishlist (user_id, listing_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $listing_id);
    $stmt->execute();
    $stmt->close();
}
$_SESSION['wlSuccess'] = "Listing with ID: " . $listing_id . " successfully added to your wishlist";
header('location: ../wishlist#my_wishlist');

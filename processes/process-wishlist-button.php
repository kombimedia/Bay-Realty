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
$listing_id = $_GET['listing_id'];
$user_id = $_SESSION['user_id'];
$ws_listing_id = true;

$stmt = $mysqli->prepare("SELECT user_id, listing_id FROM wishlist WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      if ($listing_id != $row['listing_id']) {
          $ws_listing_id = true;
      } else {
        $ws_listing_id = false;
        // echo "this listing is already in your wishlist";
        $_SESSION['wlError'] = "Listing with ID: " . $listing_id . " is already saved to your wishlist";
        header('location: ../wishlist');
        exit;
      }
  }
}
$stmt->close();

if ($ws_listing_id) {
    $stmt = $mysqli->prepare("INSERT INTO wishlist (user_id, listing_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $listing_id);
    $stmt->execute();
    $stmt->close();
}
$_SESSION['wlSuccess'] = "Listing with ID: " . $listing_id . " successfully added to your wishlist";
header('location: ../wishlist');

// print_r ("listing id" . $ws_listing_id);

// if ($listing_id != $ws_listing_id) {
//         $stmt = $mysqli->prepare("INSERT INTO wishlist (user_id, listing_id) VALUES (?, ?)");
//         $stmt->bind_param("ii", $user_id, $listing_id);
//         $stmt->execute();
//     } else {
//       //echo "this listing is already in your wishlist";
//       //header('location: ../wishlist');
//     }
// $stmt->close();


// session_start();
// include "../includes/db-connect.php";
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// $listing_id = $_GET['listing_id'];
// $user_id = $_SESSION['user_id'];

// $wislist_array = array();

// if (isset($_SESSION['guestUserName'])) {

//     $stmt = $mysqli->prepare("SELECT my_wishlist FROM users WHERE user_id = ?");
//     $stmt->bind_param("i", $user_id);
//     if (!$stmt->execute()) {
//       //echo "Select failed (" . $stmt->errno . ") " . $stmt->error; // change to a session error on page
//       exit;
//     }
//     $result = $stmt->get_result();
//     if($result->num_rows > 0) {
//       while($row = $result->fetch_assoc()) {
//         $wishlist_array = array($row['my_wishlist']);
//       }
//     }
//     $stmt->close();

//     array_push($wishlist_array, $listing_id);
//     $wishlist_array = implode(",",$wishlist_array);

//     $stmt = $mysqli->prepare("UPDATE users SET my_wishlist = ? WHERE user_id = ?");
//     $stmt->bind_param("si", $wishlist_array, $user_id);
//     if (!$stmt->execute()) {
//       //echo "Insert failed (" . $stmt->errno . ") " . $stmt->error; // change to a session error on page
//       exit;
//     }
//     $stmt->close();
//     header ('location: ../wishlist');
// } else {
//   header('location: ../guest-login');
// }

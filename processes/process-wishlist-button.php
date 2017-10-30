<?php
include "../includes/db-connect.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$listing_id = $_GET['listing_id'];
$user_id = $_SESSION['user_id'];

$wislist_array = array();

if (isset($_SESSION['guestUserName'])) {

    $stmt = $mysqli->prepare("SELECT my_wishlist FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    if (!$stmt->execute()) {
      //echo "Select failed (" . $stmt->errno . ") " . $stmt->error; // change to a session error on page
      exit;
    }
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $wishlist_array = array($row['my_wishlist']);
      }
    }
    $stmt->close();

    array_push($wishlist_array, $listing_id);
    $wishlist_array = implode(",",$wishlist_array);

    $stmt = $mysqli->prepare("UPDATE users SET my_wishlist = ? WHERE user_id = ?");
    $stmt->bind_param("si", $wishlist_array, $user_id);
    if (!$stmt->execute()) {
      //echo "Insert failed (" . $stmt->errno . ") " . $stmt->error; // change to a session error on page
      exit;
    }
    $stmt->close();
    header ('location: ../wishlist');
}
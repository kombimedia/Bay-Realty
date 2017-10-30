<?php
session_start();
include "../includes/db-connect.php";
error_reporting(E_ALL);
ini_set('display_errors', '1');
$display_wishlist = "";

$user_id = $_SESSION['user_id'];


if (isset($_SESSION['guestUserName'])) {

    $stmt = $mysqli->prepare("SELECT my_wishlist FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
     $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $my_wishlist = $row['my_wishlist'];
      

       $display_wishlist = $display_wishlist . "$my_wishlist";

       echo "Hello" . $display_wishlist;
}
$stmt->close();
}}
else {
  header('location: ../guest-login');
}

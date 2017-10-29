<?php 
include "../includes/db-connect.php";
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$listing_id = $_GET['listing_id'];
$listin_id = [];
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['guestUserName'])) { 

$stmt1 = $mysqli->prepare("SELECT my_wishlist FROM users WHERE user_id = ?");
$stmt1->bind_param("i",  $user_id);
if(!$stmt1->execute()) {
	echo "select failed ("$stmt1->errno . ") " . $stmt1->error;
}
$result = $stmt1->get_result();


if($result->num_rows > 0) {
$wislist_array = $row['my_wishlist'];	
} else {
	echo "no user row selected";
}

$stmt1->close();
array_push($wishlist_array, $listing_id); 


	
$stmt = $mysqli->prepare("UPDATE users SET my_wishlist = ? WHERE user_id = ?");
$stmt->bind_param("ii", $wishlist_array, $user_id);
if(!$stmt->execute()) {
	echo "update failed ("$stmt->errno . ") " . $stmt->error;
}

$stmt->close();

} else {
	echo "login error";
}

echo "script executed";

	// else{
	// 	header('location: ../guest-login');
	// }

   
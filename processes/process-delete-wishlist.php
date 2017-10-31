<?php

session_start();
include '../includes/db-connect.php';

$listing_id = $_GET['del_wish'];
$user_id = $_SESSION['user_id'];

if (isset($_SESSION['guestUserName'])) {

    $stmt = $mysqli->prepare("DELETE FROM wishlist WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
     $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $my_wishlist = $row['my_wishlist'];

       $my_wishlist = explode(',', $my_wishlist);

       
  }
}
$stmt->close();

foreach ($my_wishlist as  $wish) {


 
	if($wish === $listing_id) {

		unset($wish);

// Remove from array

	}

}
}
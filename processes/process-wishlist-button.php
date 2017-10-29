<?php

session_start();
if (isset($_SESSION['guestUserName'])) {

	$listing_id = $_GET['listing_id'];




  $stmt1 = $mysqli->prepare("INSERT INTO agents (wishlist) VALUES (?) WHERE ");
        $stmt1->bind_param("sssssis", $_POST['listing_id']);

 $stmt->execute();
 $result = $stmt->get_result();
 if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      // Loop through each row and save the array to a variable
      $first_name = $row['first_name'];
   }

	else{
		header('location: ../guest-login');
	};

<?php 

session_start();
if (isset($_SESSION['guestUserName'])) { header('location: ../wishlist'); }

	else{
		header('location: ../guest-login');
	};
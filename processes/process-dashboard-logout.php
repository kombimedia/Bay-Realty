<?php
session_start();
// Once 'log out' link is clicked, set logged in session to false
$_SESSION['logged_in'] = false;
// Remove 'Welcome user' message
unset($_SESSION['userName']);
header('location: ../dashboard-login');

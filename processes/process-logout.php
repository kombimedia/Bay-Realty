<?php
session_start();
$_SESSION['logged_in'] = false;
unset($_SESSION['guestUserName']);
header('location: ../guest-login');

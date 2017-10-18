<?php
session_start();
$_SESSION['logged_in'] = false;
unset($_SESSION['userName']);
header('location: ../dashboard-login');

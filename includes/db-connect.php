<?php
// Create connection to remote database
$mysqli = new mysqli ("localhost","db_user","password", "db_name");
    // Check connection
    if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
    }

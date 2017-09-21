<?php 

$mysqli = new mysqli ("74.124.197.222:3306","bayrealt_user","AZ]wpGNUWT+K", "bayrealt_db");
    // Check connection
        if ($mysqli->connect_error) {
          die("Connection failed: " . $mysqli->connect_error);
        } 
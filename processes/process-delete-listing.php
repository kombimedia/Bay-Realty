<?php
session_start();
include '../includes/db-connect.php';
    // Delete images from db
    $deleteData = "DELETE FROM images
                   WHERE listing_id ='".$_GET['del_listing']."'";
    if ($mysqli->query($deleteData)) {
        $_SESSION["listDelSuccess"] = "<div class='success-message'>Images successfully deleted</div>";
    } else {
        $_SESSION["listDelError"] = "<div class='error-message'>Images were not deleted. Please contact website administrator</div>";
    }

    // Delete listing from db
    $deleteData1 = "DELETE FROM properties
                    WHERE listing_id ='".$_GET['del_listing']."'";
    if ($mysqli->query($deleteData1)) {
        $_SESSION["listDelSuccess"] = "<div class='success-message'>Listing successfully deleted</div>";
    } else {
        $_SESSION["listDelError"] = "<div class='error-message'>Listing was not deleted. Please contact website administrator</div>";
    }
$mysqli->close();
header('location: ../dashboard-view-listings');

?>

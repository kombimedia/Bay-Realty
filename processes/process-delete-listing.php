<?php
session_start();
include '../includes/db-connect.php';
    // Delete images from db
    $deleteData = "DELETE FROM images
                   WHERE listing_id ='".$_GET['del_listing']."'";
    if ($mysqli->query($deleteData)) {
        $_SESSION["listDelSuccess"] = "<div class='list-del-success'>Images successfully deleted</div>";
        //echo "Record deleted successfully";
    } else {
        $_SESSION["listDelError"] = "<div class='list-del-error'>Images were not deleted. Please contact website administrator</div>";
        //echo "Error deleting record: " $deleteData . " " . $mysqli->error;
    }

    // Delete listing from db
    $deleteData1 = "DELETE FROM properties
                    WHERE listing_id ='".$_GET['del_listing']."'";
    if ($mysqli->query($deleteData1)) {
        $_SESSION["listDelSuccess"] = "<div class='list-del-success'>Listing successfully deleted</div>";
        //echo "Record deleted successfully";
    } else {
        $_SESSION["listDelError"] = "<div class='list-del-error'>Listing was not deleted. Please contact website administrator</div>";
        //echo "Error deleting record: " $deleteData . " " . $mysqli->error;
    }
$mysqli->close();
header('location: ../dashboard-view-listings');

?>

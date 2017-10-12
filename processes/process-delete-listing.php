<?php
session_start();
include '../includes/db-connect.php';

// Delete images from uploads folder
$deleteImages = "SELECT img_name
                 FROM images
                 WHERE listing_id ='".$_GET['del_listing']."'";
$result = $mysqli->query($deleteImages);
        // Loop through data and output each row
        while($row = $result->fetch_assoc()) {
            $path = "../images/uploads/" . $row['img_name'];
            unlink($path);
    }

// Delete images from db
$deleteData = "DELETE FROM images
               WHERE listing_id ='".$_GET['del_listing']."'";
if ($mysqli->query($deleteData)) {
    $_SESSION["listDelSuccess"] = "<div class='success-message'>Image(s) successfully deleted</div>";
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

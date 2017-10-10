<?php
session_start();
include '../includes/db-connect.php';

// Delete image from uploads folder
$deleteFile = "SELECT img_name
               FROM images
               WHERE image_id ='".$_GET['del_image']."'";
$result = $mysqli->query($deleteFile);
    // Check if there are any records to show
    if ($result->num_rows > 0) {
        // Loop through data and output each row
        while($row = $result->fetch_assoc()) {
            $path = "../images/uploads/" . $row['img_name'];
    }
    unlink($path);
}

// Delete images from db
$deleteData = "DELETE FROM images
               WHERE image_id ='".$_GET['del_image']."'";
if ($mysqli->query($deleteData)) {
    $_SESSION["imageDelSuccess"] = "<div class='success-message'>Image successfully deleted</div>";
} else {
    $_SESSION["imageDelError"] = "<div class='error-message'>Images were not deleted. Please contact website administrator</div>";
}


$_SESSION["path"] = "Path is: ".$path;

$mysqli->close();
header('location: ../dashboard-images');
?>

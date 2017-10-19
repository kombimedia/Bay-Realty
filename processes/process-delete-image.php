<?php
session_start();
include '../includes/db-connect.php';

// Delete image from uploads folder
$stmt = $mysqli->prepare ("SELECT img_name FROM images WHERE image_id = ?");
$stmt->bind_param ("i", $_GET['del_image']);
$stmt->execute ();
$result = $stmt->get_result ();
if ($result->num_rows === 1) {
  $row = $result->fetch_assoc ();
  // Define path to image file
  $path = "../images/uploads/" . $row['img_name'];
  } else {
      // If no matching images are found there is an issue so throw error
      $_SESSION["imageDelFileError"] = "<div class='error-message'>Image was not deleted from the server. Please contact website administrator</div>";
    }
  // Delete image files from folder
  unlink($path);
  $stmt->close();

// Delete images from db
$stmt = $mysqli->prepare("DELETE FROM images WHERE image_id = ?");
$stmt->bind_param("i", $_GET['del_image']);
if ($stmt->execute()) {
  $_SESSION["imageDelSuccess"] = "<div class='success-message'>Image successfully deleted</div>";
  } else {
      // If no matching images are found there is an issue so throw error
      $_SESSION["imageDelError"] = "<div class='error-message'>Image was not deleted from the database. Please contact website administrator</div>";
  }
  $stmt->close();

  $mysqli->close();
  header('location: ../dashboard-images');
?>

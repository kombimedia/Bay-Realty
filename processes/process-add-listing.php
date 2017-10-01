<?php
session_start();
include '../includes/db-connect.php';

// Set variables
$agent = ($_POST['salesAgent']);
$lTitle = ($_POST['listingTitle']);
$address = ($_POST['streetAddress']);
$city = ($_POST['city']);
$type = ($_POST['propertyType']);
$price = ($_POST['price']);
$sMethod = ($_POST['saleMethod']);
$bedrooms = ($_POST['bedrooms']);
$bedD = ($_POST['bedDescription']);
$bathrooms = ($_POST['bathrooms']);
$bathD = ($_POST['bathDescription']);
$lounges = ($_POST['lounges']);
$loungeD = ($_POST['loungeDescription']);
$garages = ($_POST['garages']);
$garageD = ($_POST['garageDescription']);
$houseSize = ($_POST['houseSize']);
$landSize = ($_POST['landSize']);
$map = ($_POST['mapCoord']);
$fImage = ($_POST['fImage']);
$pImage = ($_POST['pImage']);
$fListing = ($_POST['fListing']);
// Global session variables
$_SESSION["storeSalesAgent"] = $agent;
$_SESSION["storeListingTitle"] = $lTitle;
$_SESSION["storeStreetAddress"] = $address;
$_SESSION["storeCity"] = $city;
$_SESSION["storePropertyType"] = $type;
$_SESSION["storePrice"] = $price;
$_SESSION["storeSaleMethod"] = $sMethod;
$_SESSION["storeBedrooms"] = $bedrooms;
$_SESSION["storeBedDescription"] = $bedD;
$_SESSION["storeBathrooms"] = $bathrooms;
$_SESSION["storeBathDescription"] = $bathD;
$_SESSION["storeLounges"] = $lounges;
$_SESSION["storeLoungeDescription"] = $loungeD;
$_SESSION["storeGarages"] = $garages;
$_SESSION["storeGarageDescription"] = $garageD;
$_SESSION["storeHouseSize"] = $houseSize;
$_SESSION["storeLandSize"] = $landSize;
$_SESSION["storeMapCoord"] = $map;
$_SESSION["storeFImage"] = $fImage;
$_SESSION["storePImage"] = $pImage;
$_SESSION["storeFListing"] = $fListing;

// Upload images and save to 'uploads' folder
if(isset($_POST['submitAddListing'])) {
  for($i = 0;$i<count($_FILES["upload_file"]["name"]);$i++) {
     $uploadfile = $_FILES["upload_file"]["tmp_name"][$i];
     $folder = "../images/uploads/";
     move_uploaded_file($_FILES["upload_file"]["tmp_name"][$i], "$folder".$_FILES["upload_file"]["name"][$i]);
  }
}

// Insert new listing into database
$addData = "INSERT INTO properties (address, price, sell_method, title, type, map_co_ords, agents, images, featured_image, categories, bed_no, bed_des, bath_no, bath_des, garage_no, garage_des, lounge_no, lounge_des, house_size, land_size, featured_property)
    VALUES ('$address', '$price', '$sMethod', '$lTitle', '$type', '$map', '$agent', '$folder', '$uploadfile', '$city', '$bedrooms', '$bedD', '$bathrooms', '$bathD', '$garages', '$garageD', '$lounges', '$loungeD',  '$houseSize', '$landSize', '$fListing')";
    // if insert is successful go back to dashboard add listing page and print success message
    if ($mysqli->query($addData)) {
        $_SESSION["dbSuccess"] = "<div class='db-success'>New listing successfully added</div>";
        header('Location: ../dashboard-add-listing');
    }  else {
      // if insert is unsuccessful throw error
       $_SESSION["dbError"] = "<div class='db-error'>Something went wrong! Please check that all fields have been filled correctly</div>";
        // $_SESSION["dbError"] = "<div class='db-error'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
        header('location: ../dashboard-add-listing');
       }
       // close db connection
       $mysqli->close();



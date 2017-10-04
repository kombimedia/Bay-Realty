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
//$images = ($_SESSION['images']);
//$images = $images +1;
$fListing = ($_POST['fListing']);
// Global session variables

$_SESSION["storeListingTitle"] = $lTitle;
$_SESSION["storeStreetAddress"] = $address;
$_SESSION["storePrice"] = $price;
$_SESSION["storeSaleMethod"] = $sMethod;
$_SESSION["storeBedDescription"] = $bedD;
$_SESSION["storeBathDescription"] = $bathD;
$_SESSION["storeLoungeDescription"] = $loungeD;
$_SESSION["storeGarageDescription"] = $garageD;
$_SESSION["storeHouseSize"] = $houseSize;
$_SESSION["storeLandSize"] = $landSize;
$_SESSION["storeMapCoord"] = $map;
//$_SESSION["storePImage"] = $images;

// Insert new listing into database
$addData = "INSERT INTO properties (agents, title, address, categories, type, price, sell_method, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property)
    VALUES ('$agent', '$lTitle', '$address', '$city', '$type', '$price', '$sMethod', '$bedrooms', '$bedD', '$bathrooms', '$bathD', '$lounges', '$loungeD', '$garages', '$garageD', '$houseSize', '$landSize', '$map', '$fListing')";
    // if insert is successful go back to dashboard add listing page and print success message
    if ($mysqli->query($addData)) {
        $_SESSION["dbSuccess"] = "<div class='db-success'>New listing successfully created</div>";
        //echo '<span class="db-success">Your listing was created successfully</span><br/><br/>';
        //header('Location: ../dashboard-add-listing');
    }  else {
      // if insert is unsuccessful throw error
       $_SESSION["dbError"] = "<div class='db-error'>Something went wrong! Please check that all fields have been filled correctly</div>";
       //echo '<span class="db-error">Something went wrong! Please check that all fields have been filled correctly</span><br/><br/>';
        //$_SESSION["dbError"] = "<div class='db-error'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
        //header('location: ../dashboard-add-listing');
       }
// close db connection
$mysqli->close();




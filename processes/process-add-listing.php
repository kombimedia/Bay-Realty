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
$propDes = ($_POST['propDes']);
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
$_SESSION["storeListingDescription"] = $propDes;

// Insert new listing into database
$addData = "INSERT INTO properties (agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property)
            VALUES ('$agent', '$lTitle', '$address', '$city', '$type', '$price', '$sMethod', '$propDes', '$bedrooms', '$bedD', '$bathrooms', '$bathD', '$lounges', '$loungeD', '$garages', '$garageD', '$houseSize', '$landSize', '$map', '$fListing')";
    // if insert is successful go back to dashboard add listing page and print success message
    if ($mysqli->query($addData)) {
        $new_listing_id = "00".mysqli_insert_id($mysqli);
        $_SESSION["dbSuccess"] = "<div class='success-message'>New listing successfully created. New listing ID is: " . $new_listing_id . "</div>";
    }  else {
      // if insert is unsuccessful throw error
       $_SESSION["dbError"] = "<div class='error-message'>Something went wrong! Please check that all fields have been filled correctly</div>";
       //$_SESSION["dbError"] = "<div class='error-message'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
       }
       $_SESSION["new_listing_id"] = $new_listing_id;
       //exit()

// close db connection
$mysqli->close();




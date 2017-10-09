<?php
session_start();
include '../includes/db-connect.php';

// Set variables
$update_listing_id = $_SESSION["update_listing_id"];
$agent = ($_POST['updateSalesAgent']);
$lTitle = ($_POST['updateListingTitle']);
$address = ($_POST['updateStreetAddress']);
$city = ($_POST['updateCity']);
$type = ($_POST['updatePropertyType']);
$price = ($_POST['updatePrice']);
$sMethod = ($_POST['updateSaleMethod']);
$bedrooms = ($_POST['updateBedrooms']);
$bedD = ($_POST['updateBedDescription']);
$bathrooms = ($_POST['updateBathrooms']);
$bathD = ($_POST['updateBathDescription']);
$lounges = ($_POST['updateLounges']);
$loungeD = ($_POST['updateLoungeDescription']);
$garages = ($_POST['updateGarages']);
$garageD = ($_POST['updateGarageDescription']);
$houseSize = ($_POST['updateHouseSize']);
$landSize = ($_POST['updateLandSize']);
$map = ($_POST['updateMapCoord']);
$fListing = ($_POST['updateFListing']);

// Insert new listing into database
$addData = "UPDATE properties
            SET agents = '$agent', title = '$lTitle', address = '$address', categories = '$city', type = '$type', price = '$price', sell_method = '$sMethod', bed_no = '$bedrooms', bed_des = '$bedD', bath_no = '$bathrooms', bath_des = '$bathD', lounge_no = '$lounges', lounge_des = '$loungeD', garage_no = '$garages', garage_des = '$garageD', house_size = '$houseSize', land_size = '$landSize', map_co_ords = '$map', featured_property = '$fListing'
            WHERE listing_id = $update_listing_id";
    // if insert is successful go back to dashboard view listing page and print success message
    if ($mysqli->query($addData)) {
        $_SESSION["updateListingSuccess"] = "<div class='success-message'>Listing updated successfully</div>";
    }  else {
      // if insert is unsuccessful throw error
       $_SESSION["updateListingError"] = "<div class='error-message'>Something went wrong! Please try again</div>";
       ///$_SESSION["updateListingError"] = "<div class='error-message'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
       }
// close db connection
$mysqli->close();
header('location: ../dashboard-view-listings');




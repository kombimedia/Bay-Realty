<?php
session_start();
include '../includes/db-connect.php';
include 'process-functions-validation.php';

// Save form data to global variables to repopulate form if submit fails
$_SESSION["storeListingTitle"] = $_POST['listingTitle'];
$_SESSION["storeStreetAddress"] = $_POST['streetAddress'];
$_SESSION["storePrice"] = $_POST['price'];
$_SESSION["storeSaleMethod"] = $_POST['saleMethod'];
$_SESSION["storeBedDescription"] = $_POST['bedDescription'];
$_SESSION["storeBathDescription"] = $_POST['bathDescription'];
$_SESSION["storeLoungeDescription"] = $_POST['loungeDescription'];
$_SESSION["storeGarageDescription"] = $_POST['garageDescription'];
$_SESSION["storeHouseSize"] = $_POST['houseSize'];
$_SESSION["storeLandSize"] = $_POST['landSize'];
$_SESSION["storeMapCoord"] = $_POST['mapCoord'];
$_SESSION["storeListingDescription"] = $_POST['propDes'];
if (isset($_POST['salesAgent'])) {
    $_SESSION['storeAgent'] = $_POST['salesAgent'];
}
if (isset($_POST['city'])) {
    $_SESSION['storeCity'] = $_POST['city'];
}
if (isset($_POST['propertyType'])) {
    $_SESSION['storeType'] = $_POST['propertyType'];
}
if (isset($_POST['bedrooms'])) {
    $_SESSION['storeBeds'] = $_POST['bedrooms'];
}
if (isset($_POST['bathrooms'])) {
    $_SESSION['storeBath'] = $_POST['bathrooms'];
}
if (isset($_POST['lounges'])) {
    $_SESSION['storeLounge'] = $_POST['lounges'];
}
if (isset($_POST['garages'])) {
    $_SESSION['storeGarage'] = $_POST['garages'];
}



// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate entry for Sales Agent
    $valid_agent = true;
    if (empty($_POST['salesAgent'])) {
        $_SESSION["agentError"] = "<div class='validate-error-message'>Oops... Please select an Agent.</div>";
        $valid_agent = false;
    }

    // Validate entry Listing Title
    $valid_title = true;
    if (!validate_listing_title ($_POST['listingTitle'])) {
        $valid_title = false;
    }

    // Valid entry Street Address
    $valid_address = true;
    if (!validate_street_address ($_POST['streetAddress'])) {
        $valid_address = false;
    }

    // Valid entry City
    $valid_city = true;
    // Check that the field has an entry
    if (empty($_POST['city'])) {
        $_SESSION["cityError"] = "<div class='validate-error-message'>Oops... Please select a City.</div>";
        $valid_city = false;
    }

    // Valid entry Property Type
    $valid_type = true;
    // Check that the field has an entry
    if (empty($_POST['propertyType'])) {
        $_SESSION["typeError"] = "<div class='validate-error-message'>Oops... Please select a Property Type.</div>";
        $valid_type = false;
    }

    // Valid entry Price
    $valid_price = true;
    if (!validate_price ($_POST['price'])) {
        $valid_price = false;
    }

    // Valid entry Sale Method
    $valid_sale_method = true;
    if (!validate_sale_method ($_POST['saleMethod'])) {
        $valid_sale_method = false;
    }

    // Valid entry Bedrooms
    $valid_bedrooms = true;
    // Check that the field has an entry
    if (empty($_POST['bedrooms'])) {
        $_SESSION["bedError"] = "<div class='validate-error-message'>Oops... Please select a number of Bedrooms.</div>";
        $valid_bedrooms = false;
    }

    // Valid entry Bedroom Description
    $valid_bed_des = true;
    if (!validate_bedroom_description ($_POST['bedDescription'])) {
        $valid_bed_des = false;
    }

    // Valid entry Bathrooms
    $valid_bathrooms = true;
    // Check that the field has an entry
    if (empty($_POST['bathrooms'])) {
        $_SESSION["bathError"] = "<div class='validate-error-message'>Oops... Please select a number of Bathrooms.</div>";
        $valid_bathrooms = false;
    }

    // Valid entry Bathroom Description
    $valid_bath_des = true;
    if (!validate_bathroom_description ($_POST['bathDescription'])) {
        $valid_bath_des = false;
    }

    // Valid entry Lounges
    $valid_lounges = true;
    // Check that the field has an entry
    if (empty($_POST['lounges'])) {
        $_SESSION["loungeError"] = "<div class='validate-error-message'>Oops... Please select a number of Lounges.</div>";
        $valid_lounges = false;
    }

    // Valid entry Lounge Description
    $valid_lounge_des = true;
    if (!validate_lounge_description($_POST['loungeDescription'])) {
        $valid_lounge_des = false;
    }

    // Valid entry Garages
    $valid_garages = true;
    // Check that the field has an entry
    if (empty($_POST['garages'])) {
        $_SESSION["garageError"] = "<div class='validate-error-message'>Oops... Please select a number of Garages.</div>";
        $valid_garages = false;
    }

    // Valid entry Garage Description
    $valid_garage_des = true;
    if (!validate_garage_description($_POST['garageDescription'])) {
        $valid_garage_des = false;
    }

    // Valid entry House Size
    $valid_h_size = true;
    if (!validate_house_size($_POST['houseSize'])) {
        $valid_h_size = false;
    }

    // Valid entry Land Size
    $valid_l_size = true;
    if (!validate_land_size($_POST['landSize'])) {
        $valid_l_size = false;
    }

    // Valid entry Map Co-ordinates
    $valid_map = true;
    if (!validate_map_coords($_POST['mapCoord'])) {
        $valid_map = false;
    }

    // Valid entry Property Description
    $valid_prop_des = true;
    if(!validate_property_description($_POST['propDes'])) {
        $valid_prop_des = false;
    }

    // Ensure check box returns 1 or 0
    if (isset($_POST['fListing'])) {
        $_POST['fListing'] = 1;
    } else {
        $_POST['fListing'] = 0;
    }

    // Validate image(s) and store in the temp folder until we need to use them
    $valid_image = true;
    if (!validate_image_temp_folder($_FILES['file'])) {
        $valid_image = false;
    }

}

$valid_listing = $valid_agent && $valid_title && $valid_address && $valid_city && $valid_type && $valid_price && $valid_sale_method && $valid_bedrooms && $valid_bed_des && $valid_bathrooms && $valid_bath_des && $valid_lounges && $valid_lounge_des && $valid_garages && $valid_garage_des && $valid_h_size && $valid_l_size && $valid_map && $valid_prop_des && $valid_image;

if ($valid_listing) {

    // Insert new listing into database
    $stmt = $mysqli->prepare("INSERT INTO properties (agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiidsssssssssssssi", $_POST['salesAgent'], $_POST['listingTitle'], $_POST['streetAddress'], $_POST['city'], $_POST['propertyType'], $_POST['price'], $_POST['saleMethod'], $_POST['propDes'], $_POST['bedrooms'], $_POST['bedDescription'], $_POST['bathrooms'], $_POST['bathDescription'], $_POST['lounges'], $_POST['loungeDescription'], $_POST['garages'], $_POST['garageDescription'], $_POST['houseSize'], $_POST['landSize'], $_POST['mapCoord'], $_POST['fListing']);
    // if insert execution fails throw error
    if (!$stmt->execute()) {
          //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
          $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . ".<br>Please see your website administrator and quote this error message.</div>";
          $stmt->close();
          header('location: ../dashboard-add-listing');
          exit;
    }
    // Get the just created listing_id and save to a variable
    $new_listing_id = mysqli_insert_id($mysqli);
    // Close query
    $stmt->close();
} else {
    header('Location: ../dashboard-add-listing.php');
    exit;
}

// Get image(s) data from temp folder, rename image(s) with listing id, insert image details into db
// Define temporary directory where images are stored
$tempdir = "../images/temp/";
// Define images to get from folder
$image_files = glob("$tempdir{*.jpg,*.jpeg,*.png}", GLOB_BRACE);
//loop through images array to get individual element - name, extension
for ($i = 0; $i < count($image_files); $i++) {
    // Get extensions and store to a variable
    $ext = explode('.', basename($image_files[$i]));
    $image_type = end($ext);
    // Get file size
    $image_size = filesize($image_files[$i]). 'Bytes';
    // Save temp file path to a variable
    $temp_files = $image_files[$i];
    // Get file name and save to a variable
    $image_name = basename($image_files[$i]);
    // Rename image and path to include property listing_id
    $image_name = $new_listing_id . '_' . $image_name;
    // Define path to uploads folder
    $file_path = "../images/uploads/" . $image_name;
    // Insert image(s) data to db
    $stmt = $mysqli->prepare("INSERT INTO images (img_name, img_size, img_type, listing_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $image_name, $image_size, $image_type, $new_listing_id);
    // if insert execution is unsuccessful throw error
    if (!$stmt->execute()) {
          $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Image data wasn't added to the database. Please contact the site administrator</div>";
          //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
          $stmt->close();
          header('location: ../dashboard-add-listing');
          exit;
    }
    $stmt->close();

    // Add featured image file name to the properties table, featured_image
    $stmt = $mysqli->prepare("UPDATE properties SET featured_image = ? WHERE listing_id = ?");
    $stmt->bind_param("si", $image_name, $new_listing_id);
    // if update execution is unsuccessful throw error
    if (!$stmt->execute()) {
        $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... The featured image wasn't added to the database. Please contact the site administrator</div>";
        //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
        $stmt->close();
        header('location: ../dashboard-add-listing');
        exit;
    }
    $stmt->close();

    // Move image file(s) from temp folder to uploads folder
    if (!rename($temp_files, $file_path)) {
        // if file was not moved throw error message
        $_SESSION["errorMessage"] = "<div class='error-message'>Image(s) were not saved to uploads folder</div>";
        header('location: ../dashboard-add-listing');
        exit;
    }
}

// if listing is successfully created go back to dashboard 'add listing' page and print success message
$_SESSION["successMessage"] = "<div class='success-message'>New listing successfully created. Listing ID is: " . $new_listing_id . "</div>";
unset($_SESSION["storeListingTitle"]);
unset($_SESSION["storeStreetAddress"]);
unset($_SESSION["storePrice"]);
unset($_SESSION["storeSaleMethod"]);
unset($_SESSION["storeBedDescription"]);
unset($_SESSION["storeBathDescription"]);
unset($_SESSION["storeLoungeDescription"]);
unset($_SESSION["storeGarageDescription"]);
unset($_SESSION["storeHouseSize"]);
unset($_SESSION["storeLandSize"]);
unset($_SESSION["storeMapCoord"]);
unset($_SESSION["storeListingDescription"]);
unset($_SESSION['storeAgent']);
unset($_SESSION['storeCity']);
unset($_SESSION['storeType']);
unset($_SESSION['storeBeds']);
unset($_SESSION['storeBath']);
unset($_SESSION['storeLounge']);
unset($_SESSION['storeGarage']);
header('location: ../dashboard-add-listing');

// close db connection
$mysqli->close();














// session_start();
//     include '../includes/db-connect.php';

//     // Get post data from validation script
//     $_POST['sales_agent'] = $_SESSION["storeSalesAgent"];
//     $listing_title = $_SESSION["storeListingTitle"];
//     $address = $_SESSION["storeStreetAddress"];
//     $city = $_SESSION["storeCity"];
//     $type = $_SESSION["storePropertyType"];
//     $price = $_SESSION["storePrice"];
//     $sell_method = $_SESSION["storeSaleMethod"];
//     $bedrooms = $_SESSION["storeBedrooms"];
//     $bed_des = $_SESSION["storeBedDescription"];
//     $bathrooms = $_SESSION["storeBathrooms"];
//     $bath_des = $_SESSION["storeBathDescription"];
//     $lounges = $_SESSION["storeLounges"];
//     $lounge_des = $_SESSION["storeLoungeDescription"];
//     $garages = $_SESSION["storeGarages"];
//     $garage_des = $_SESSION["storeGarageDescription"];
//     $house_size = $_SESSION["storeHouseSize"];
//     $land_size = $_SESSION["storeLandSize"];
//     $map_co_ords = $_SESSION["storeMapCoord"];
//     $property_des = $_SESSION["storeListingDescription"];
//     $featured_listing = $_SESSION["storeFeaturedListing"];

//     // Save form data to global variables to repopulate form if submit fails
//     $_SESSION["storeListingTitle"] = $listing_title;
//     $_SESSION["storeStreetAddress"] = $address;
//     $_SESSION["storePrice"] = $price;
//     $_SESSION["storeSaleMethod"] = $sell_method;
//     $_SESSION["storeBedDescription"] = $bed_des;
//     $_SESSION["storeBathDescription"] = $bath_des;
//     $_SESSION["storeLoungeDescription"] = $lounge_des;
//     $_SESSION["storeGarageDescription"] = $garage_des;
//     $_SESSION["storeHouseSize"] = $house_size;
//     $_SESSION["storeLandSize"] = $land_size;
//     $_SESSION["storeMapCoord"] = $map_co_ords;
//     $_SESSION["storeListingDescription"] = $property_des;

//     // Insert new listing into database
//     $stmt = $mysqli->prepare("INSERT INTO properties (agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("issiidssisisisissssi", $_POST['sales_agent'], $listing_title, $address, $city, $type, $price, $sell_method, $property_des, $bedrooms, $bed_des, $bathrooms, $bath_des, $lounges, $lounge_des, $garages, $garage_des, $house_size, $land_size, $map_co_ords, $featured_listing);
//     // if insert execution fails throw error
//     if (!$stmt->execute()) {
//           $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
//           //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
//           $stmt->close();
//           header('location: ../dashboard-add-listing');
//           exit;
//     }
//     // Get the just created listing_id and save to a variable
//     $new_listing_id = mysqli_insert_id($mysqli);
//     // Close query
//     $stmt->close();

//     // Define directory where images are stored
//     $tempdir = "../images/temp/";
//     // Define images to get from folder
//     $image_files = glob("$tempdir{*.jpg,*.jpeg,*.png}", GLOB_BRACE);
//     //loop through images array to get individual element - name, extension
//     for ($i = 0; $i < count($image_files); $i++) {
//         // Get extensions and store to a variable
//         $ext = explode('.', basename($image_files[$i]));
//         $image_type = end($ext);
//         // Get file size
//         $image_size = filesize($image_files[$i]). 'Bytes';
//         // Save temp file path to a variable
//         $temp_files = $image_files[$i];
//         // Get file name to a variable
//         $image_name = basename($image_files[$i]);
//         // Rename image and path to include property listing_id
//         $image_name = $new_listing_id . '_' . $image_name;
//         // Define path to uploads folder
//         $file_path = "../images/uploads/" . $image_name;

//         $stmt = $mysqli->prepare("INSERT INTO images (img_name, img_size, img_type, listing_id) VALUES (?, ?, ?, ?)");
//         $stmt->bind_param("sssi", $image_name, $image_size, $image_type, $new_listing_id);
//         // if insert execution is unsuccessful throw error
//         if (!$stmt->execute()) {
//               $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Image data wasn't added to the database. Please contact the site administrator</div>";
//               //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
//               $stmt->close();
//               header('location: ../dashboard-add-listing');
//               exit;
//         }
//         $stmt->close();

//         // Add featured image file name to the properties table, featured_image
//         $stmt = $mysqli->prepare("UPDATE properties SET featured_image = ? WHERE listing_id = ?");
//         $stmt->bind_param("si", $image_name, $new_listing_id);
//         // if update execution is unsuccessful throw error
//         if (!$stmt->execute()) {
//             $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... The featured image wasn't added to the database. Please contact the site administrator</div>";
//             //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
//             $stmt->close();
//             header('location: ../dashboard-add-listing');
//             exit;
//         }
//         $stmt->close();

//         // Move images from temp folder to uploads folder
//         if (!rename($temp_files, $file_path)) {
//             // if file was not moved throw error message
//             $_SESSION["errorMessage"] = "<div class='error-message'>Image(s) were not saved to uploads folder</div>";
//             header('location: ../dashboard-add-listing');
//             exit;
//         }
//     }

// // if listing is successfully created go back to dashboard 'add listing' page and print success message
// $_SESSION["successMessage"] = "<div class='success-message'>New listing successfully created. Listing ID is: " . $new_listing_id . "</div>";
// header('location: ../dashboard-add-listing');

// // close db connection
// $mysqli->close();




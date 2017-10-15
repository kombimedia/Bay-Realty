<?php
session_start();
//if (isset($_POST['submit'])) {

    include '../includes/db-connect.php';

    // Get post data from validation script
    $sales_agent = $_SESSION["storeSalesAgent"];
    $listing_title = $_SESSION["storeListingTitle"];
    $address = $_SESSION["storeStreetAddress"];
    $city = $_SESSION["storeCity"];
    $type = $_SESSION["storePropertyType"];
    $price = $_SESSION["storePrice"];
    $sell_method = $_SESSION["storeSaleMethod"];
    $bedrooms = $_SESSION["storeBedrooms"];
    $bed_des = $_SESSION["storeBedDescription"];
    $bathrooms = $_SESSION["storeBathrooms"];
    $bath_des = $_SESSION["storeBathDescription"];
    $lounges = $_SESSION["storeLounges"];
    $lounge_des = $_SESSION["storeLoungeDescription"];
    $garages = $_SESSION["storeGarages"];
    $garage_des = $_SESSION["storeGarageDescription"];
    $house_size = $_SESSION["storeHouseSize"];
    $land_size = $_SESSION["storeLandSize"];
    $map_co_ords = $_SESSION["storeMapCoord"];
    $property_des = $_SESSION["storeListingDescription"];
    $featured_listing = $_SESSION["storeFeaturedListing"];

    // Save form data to global variables to repopulate form if submit fails
    $_SESSION["storeListingTitle"] = $listing_title;
    $_SESSION["storeStreetAddress"] = $address;
    $_SESSION["storePrice"] = $price;
    $_SESSION["storeSaleMethod"] = $sell_method;
    $_SESSION["storeBedDescription"] = $bed_des;
    $_SESSION["storeBathDescription"] = $bath_des;
    $_SESSION["storeLoungeDescription"] = $lounge_des;
    $_SESSION["storeGarageDescription"] = $garage_des;
    $_SESSION["storeHouseSize"] = $house_size;
    $_SESSION["storeLandSize"] = $land_size;
    $_SESSION["storeMapCoord"] = $map_co_ords;
    $_SESSION["storeListingDescription"] = $property_des;

    // Insert new listing into database
    $stmt = $mysqli->prepare("INSERT INTO properties (agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiidssisisisissssi", $sales_agent, $listing_title, $address, $city, $type, $price, $sell_method, $property_des, $bedrooms, $bed_des, $bathrooms, $bath_des, $lounges, $lounge_des, $garages, $garage_des, $house_size, $land_size, $map_co_ords, $featured_listing);
    // if insert execution fails throw error
    if (!$stmt->execute()) {
          $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
          //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
          $stmt->close();
          header('location: ../dashboard-add-listing');
          exit;
    }
    // Get the just created listing_id and save to a variable
    $new_listing_id = mysqli_insert_id($mysqli);
    // Close query
    $stmt->close();

    // Define directory where images are stored
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
        // Get file name to a variable
        $image_name = basename($image_files[$i]);
        // Rename image and path to include property listing_id
        $image_name = $new_listing_id . '_' . $image_name;
        // Define path to uploads folder
        $file_path = "../images/uploads/" . $image_name;

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

        // Move images from temp folder to uploads folder
        if (!rename($temp_files, $file_path)) {
            // if file was not moved throw error message
            $_SESSION["errorMessage"] = "<div class='error-message'>Image(s) were not saved to uploads folder</div>";
            header('location: ../dashboard-add-listing');
            exit;
        }
    }

// if listing is successfully created go back to dashboard 'add listing' page and print success message
$_SESSION["successMessage"] = "<div class='success-message'>New listing successfully created. Listing ID is: " . $new_listing_id . "</div>";
header('location: ../dashboard-add-listing');

//}
// close db connection
$mysqli->close();




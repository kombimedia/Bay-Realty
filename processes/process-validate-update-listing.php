<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Save form data to global variables to repopulate form if submit fails
    $_SESSION["storeListingTitle"] = $_POST['updateListingTitle'];
    $_SESSION["storeStreetAddress"] = $_POST['updateStreetAddress'];
    $_SESSION["storePrice"] = $_POST['updatePrice'];
    $_SESSION["storeSaleMethod"] = $_POST['updateSaleMethod'];
    $_SESSION["storeBedDescription"] = $_POST['updateBedDescription'];
    $_SESSION["storeBathDescription"] = $_POST['updateBathDescription'];
    $_SESSION["storeLoungeDescription"] = $_POST['updateLoungeDescription'];
    $_SESSION["storeGarageDescription"] = $_POST['updateGarageDescription'];
    $_SESSION["storeHouseSize"] = $_POST['updateHouseSize'];
    $_SESSION["storeLandSize"] = $_POST['updateLandSize'];
    $_SESSION["storeMapCoord"] = $_POST['updateMapCoord'];
    $_SESSION["storeListingDescription"] = $_POST['updatePropDes'];

    // Valid entry for Sales Agent
    $valid_agent = true;
    $_SESSION["storeSalesAgent"] = $_POST['updateSalesAgent'];

    // Valid entry Listing Title
    $valid_title = true;
    // Check that the field has an entry
    if (empty($_POST['listingTitle'])) {
        $_SESSION["titleError"] = "<div class='validate-error-message'>Oops... Please enter a listing title.</div>";
        $valid_title = false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($_POST['listingTitle']) > 55) {
          $_SESSION["titleError"] = "<div class='validate-error-message'>Oops... Listing title must be max 55 characters.</div>";
          $valid_title = false;
    }

    // Valid entry Street Address
    $valid_address = true;
    // Check that the field has an entry
    if (empty($_POST['streetAddress'])) {
        $_SESSION["addressError"] = "<div class='validate-error-message'>Oops... Please enter a Street Address.</div>";
        $valid_address = false;
        // Check the string length is not more than 255 characters
    } elseif (strlen($_POST['streetAddress']) > 255) {
          $_SESSION["addressError"] = "<div class='validate-error-message'>Oops... Street address must be max 255 characters.</div>";
          $valid_address = false;
    }

    // Valid entry City
    $valid_city = true;
    $_SESSION["storeCity"] = $_POST['updateCity'];

    // Valid entry Property Type
    $valid_type = true;
    $_SESSION["storePropertyType"] = $_POST['updatePropertyType'];

    // Valid entry Price
    $valid_price = true;
    // Check that the field has an entry
    if (empty($_POST['price'])) {
        $_SESSION["priceError"] = "<div class='validate-error-message'>Oops... Please enter a Price.</div>";
        $valid_price = false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $_POST['price'])) {
          $_SESSION["priceError"] = "<div class='validate-error-message'>Oops... Price must be a number only -  No ($ or , or .).</div>";
          $valid_price = false;
    }

    // Valid entry Sale Method
    $valid_sale_method = true;
    // Check the string length is not more than the db limit - varchar(24)
    if (strlen($_POST['updateSaleMethod']) > 24) {
          $_SESSION["sMethodError"] = "<div class='validate-error-message'>Oops... Sale Method must be max 24 characters.</div>";
          $valid_sale_method = false;
    }

    // Valid entry Bedrooms
    $valid_bedrooms = true;
    $_SESSION["storeBedrooms"] = $_POST['updateBedrooms'];

    // Valid entry Bedroom Description
    $valid_bed_des = true;
    // Check that the field has an entry
    if (empty($_POST['bedDescription'])) {
        $_SESSION["bedDesError"] = "<div class='validate-error-message'>Oops... Please enter a Bedroom Description.</div>";
        $valid_bed_des = false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($_POST['bedDescription']) > 55) {
          $_SESSION["bedDesError"] = "<div class='validate-error-message'>Oops... Bedroom Description must be max 55 characters.</div>";
          $valid_bed_des = false;
    }

    // Valid entry Bathrooms
    $valid_bathrooms = true;
    $_SESSION["storeBathrooms"] = $_POST['updateBathrooms'];

    // Valid entry Bathroom Description
    $valid_bath_des = true;
    // Check that the field has an entry
    if (empty($_POST['bathDescription'])) {
        $_SESSION["bathDesError"] = "<div class='validate-error-message'>Oops... Please enter a Bathroom Description.</div>";
        $valid_bath_des = false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($_POST['bathDescription']) > 55) {
          $_SESSION["bathDesError"] = "<div class='validate-error-message'>Oops... Bathroom Description must be max 55 characters.</div>";
          $valid_bath_des = false;
    }

    // Valid entry Lounges
    $valid_lounges = true;
    $_SESSION["storeLounges"] = $_POST['updateLounges'];

    // Valid entry Lounge Description
    $valid_lounge_des = true;
    // Check that the field has an entry
    if (empty($_POST['loungeDescription'])) {
        $_SESSION["loungeDesError"] = "<div class='validate-error-message'>Oops... Please enter a Lounge Description.</div>";
        $valid_lounge_des = false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($_POST['loungeDescription']) > 55) {
          $_SESSION["loungeDesError"] = "<div class='validate-error-message'>Oops... Lounge Description must be max 55 characters.</div>";
          $valid_lounge_des = false;
    }

    // Valid entry Garages
    $valid_garages = true;
    $_SESSION["storeGarages"] = $_POST['updateGarages'];

    // Valid entry Garage Description
    $valid_garage_des = true;
    // Check that the field has an entry
    if (empty($_POST['garageDescription'])) {
        $_SESSION["garageDesError"] = "<div class='validate-error-message'>Oops... Please enter a Garage Description.</div>";
        $valid_garage_des = false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($_POST['garageDescription']) > 55) {
          $_SESSION["garageDesError"] = "<div class='validate-error-message'>Oops... Garage Description must be max 55 characters.</div>";
          $valid_garage_des = false;
    }

    // Valid entry House Size
    $valid_h_size = true;
    // Check that the field has an entry
    if (empty($_POST['houseSize'])) {
        $_SESSION["hSizeError"] = "<div class='validate-error-message'>Oops... Please enter a House Size.</div>";
        $valid_h_size = false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $_POST['houseSize'])) {
          $_SESSION["hSizeError"] = "<div class='validate-error-message'>Oops... House Size must be a number only.</div>";
          $valid_h_size = false;
    }

    // Valid entry Land Size
    $valid_l_size = true;
    // Check that the field has an entry
    if (empty($_POST['landSize'])) {
        $_SESSION["lSizeError"] = "<div class='validate-error-message'>Oops... Please enter a Land Size.</div>";
        $valid_l_size = false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $_POST['landSize'])) {
          $_SESSION["lSizeError"] = "<div class='validate-error-message'>Oops... Land Size must be a number only.</div>";
          $valid_l_size = false;
    }

    // Valid entry Map Co-ordinates
    $valid_map = true;
    // Check that the field has an entry
    if (empty($_POST['mapCoord'])) {
        $_SESSION["mapCoordError"] = "<div class='validate-error-message'>Oops... Please enter valid Map Co-ordinates.</div>";
        $valid_map = false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($_POST['mapCoord']) > 55) {
          $_SESSION["mapCoordError"] = "<div class='validate-error-message'>Oops... Map Co-ordinates must be max 55 characters.</div>";
          $valid_map = false;
    }

    // Valid entry Property Description
    $valid_prop_des = true;
    // Check that the field has an entry
    if (empty($_POST['propDes'])) {
        $_SESSION["propDesError"] = "<div class='validate-error-message'>Oops... Please enter a Property Description.</div>";
        $valid_prop_des = false;
        // Check the string length is not more than 500 characters
    } elseif (strlen($_POST['propDes']) > 500) {
          $char_count = strlen($_POST['propDes']);
          $_SESSION["propDesError"] = "<div class='validate-error-message'>Oops... Property Description must be max 500 characters. You currently have " . $char_count . " characters.</div>";
          $valid_prop_des = false;
    }

    if (isset($_POST['fListing'])) {
        $featured_listing = 1;
        $_SESSION["storeFeaturedListing"] = $featured_listing;
    } else {
        $featured_listing = 0;
        $_SESSION["storeFeaturedListing"] = $featured_listing;
    }

     // Valid entry Garages
    $valid_featured_image = true;
    //$_SESSION["storeFImage"] = $_POST['updateFImage'];

    // Validate image(s) and store in the temp folder until we need to use them
    $valid_image_upload = true;
    //loop through images array to get individual element - name, extension
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
        // Accepted extensions
        $validextensions = array('jpeg', 'jpg', 'png');
        // Separate file name from dot(.)
        $ext = explode('.', basename($_FILES['file']['name'][$i]));
        // Store extensions to a variable
        $image_type = end($ext);
        // Temporary file storage location path
        $image_tmp = $_FILES['file']['tmp_name'][$i];
        // Set image name
        $image_name = $_FILES['file']['name'][$i];
        // Get image size
        $image_size = ($_FILES['file']['size'][$i]);
        // Declare path for uploaded images
        $file_path = "../images/temp/" . $image_name;

        //Validate image before storing to temp folder
        //Limit file size to less than 500kb
        if (($image_size < 500001) && in_array($image_type, $validextensions)) {

            // Save image files to images/uploads folder
            if (!move_uploaded_file($image_tmp, $file_path)) {
                // if file was not moved throw error message
                $_SESSION["imgUploadError"] = "<div class='validate-error-message'>Uh oh... Image(s) were not saved to temp folder.</div>";
                $valid_image_upload = false;
            }
        // if file size or file type were incorrect throw error message
        } else {
                $_SESSION["imgFileError"] = "<div class='validate-error-message'>Oops... Image should be max 500kb and a jpg, jpeg or png.</div>";
                $valid_image_upload = false;
              }
    }
             // $_SESSION["imgError"] = "<div class='validate-error-message'>Please select at least one image.</div>";
             // $valid_image_upload = false;
}

$valid_listing = $valid_agent && $valid_title && $valid_address && $valid_city && $valid_type && $valid_price && $valid_sale_method && $valid_bedrooms && $valid_bed_des && $valid_bathrooms && $valid_bath_des && $valid_lounges && $valid_lounge_des && $valid_garages && $valid_garage_des && $valid_h_size && $valid_l_size && $valid_map && $valid_prop_des && $valid_featured_image && $valid_image_upload;

//if ($valid_listing) {
//     header('Location: process-update-listing.php');
// } else {
//     header('Location: ../dashboard-update-listing.php');
// }



if ($valid_listing) {

include '../includes/db-connect.php';

    // Get listing ID and save to a variable
    $update_listing_id = $_SESSION["update_listing_id"];
    // Get form data and save to variables
    $sales_agent = $_POST["updateSalesAgent"];
    $listing_title = $_POST["updateListingTitle"];
    $address = $_POST["updateStreetAddress"];
    $city = $_POST["updateCity"];
    $type = $_POST["updatePropertyType"];
    $price = $_POST["updatePrice"];
    $sell_method = $_POST["updateSaleMethod"];
    $bedrooms = $_POST["updateBedrooms"];
    $bed_des = $_POST["updateBedDescription"];
    $bathrooms = $_POST["updateBathrooms"];
    $bath_des = $_POST["updateBathDescription"];
    $lounges = $_POST["updateLounges"];
    $lounge_des = $_POST["updateLoungeDescription"];
    $garages = $_POST["updateGarages"];
    $garage_des = $_POST["updateGarageDescription"];
    $house_size = $_POST["updateHouseSize"];
    $land_size = $_POST["updateLandSize"];
    $map_co_ords = $_POST["updateMapCoord"];
    $property_des = $_POST["updatePropDes"];
    $featured_image = $_POST["updateFImage"];

    if (isset($_POST['updateFListing'])) {
        $featured_listing = 1;
    } else {
        $featured_listing = 0;
    }


    // Get post data from validation script
    // $sales_agent = $_SESSION["storeSalesAgent"];
    // $listing_title = $_SESSION["storeListingTitle"];
    // $address = $_SESSION["storeStreetAddress"];
    // $city = $_SESSION["storeCity"];
    // $type = $_SESSION["storePropertyType"];
    // $price = $_SESSION["storePrice"];
    // $sell_method = $_SESSION["storeSaleMethod"];
    // $bedrooms = $_SESSION["storeBedrooms"];
    // $bed_des = $_SESSION["storeBedDescription"];
    // $bathrooms = $_SESSION["storeBathrooms"];
    // $bath_des = $_SESSION["storeBathDescription"];
    // $lounges = $_SESSION["storeLounges"];
    // $lounge_des = $_SESSION["storeLoungeDescription"];
    // $garages = $_SESSION["storeGarages"];
    // $garage_des = $_SESSION["storeGarageDescription"];
    // $house_size = $_SESSION["storeHouseSize"];
    // $land_size = $_SESSION["storeLandSize"];
    // $map_co_ords = $_SESSION["storeMapCoord"];
    // $property_des = $_SESSION["storeListingDescription"];
    // $featured_listing = $_SESSION["storeFeaturedListing"];
    // $featured_image = $_SESSION["storeupdateFImage"];

    // Update existing listing in database
    $stmt = $mysqli->prepare("UPDATE properties SET agents = ?, title = ?, address = ?, categories = ?, type = ?, price = ?, sell_method = ?, property_des = ?, bed_no = ?, bed_des = ?, bath_no = ?, bath_des = ?, lounge_no = ?, lounge_des = ?, garage_no = ?, garage_des = ?, house_size = ?, land_size = ?, map_co_ords = ?, featured_image = ?, featured_property = ? WHERE listing_id = ?");
    $stmt->bind_param("issiidssisisisisssssii", $sales_agent, $listing_title, $address, $city, $type, $price, $sell_method, $property_des, $bedrooms, $bath_des, $bathrooms, $bath_des, $lounges, $lounge_des, $garages, $garage_des, $house_size, $land_size, $map_co_ord, $featured_image, $featured_listing, $update_listing_id);
    if (!$stmt->execute()) {
          $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
          //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
          $stmt->close();
          header('location: ../dashboard-update-listing');
          exit;
    }
    $stmt->close();

    //if (!empty($_FILES['file']['name'])) {
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
        $image_name = $update_listing_id . '_' . $image_name;
        // Define path to uploads folder
        $file_path = "../images/uploads/" . $image_name;

        $stmt = $mysqli->prepare("INSERT INTO images (img_name, img_size, img_type, listing_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $image_name, $image_size, $image_type, $update_listing_id);
        // if insert execution is unsuccessful throw error
        if (!$stmt->execute()) {
              $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Image data wasn't added to the database. Please contact the site administrator</div>";
              //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
              $stmt->close();
              header('location: ../dashboard-update-listing');
        }
        $stmt->close();

        // Add featured image file name to the properties table, featured_image
        $stmt = $mysqli->prepare("UPDATE properties SET featured_image = ? WHERE listing_id = ?");
        $stmt->bind_param("si", $image_name, $update_listing_id);
        // if update execution is unsuccessful throw error
        if (!$stmt->execute()) {
            $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... The featured image wasn't added to the database. Please contact the site administrator</div>";
            //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
            $stmt->close();
            header('location: ../dashboard-update-listing');
        }
        $stmt->close();

        // Move images from temp folder to uploads folder
        if (!rename($temp_files, $file_path)) {
            // if file was not moved throw error message
            $_SESSION["errorMessage"] = "<div class='error-message'>Image(s) were not saved to uploads folder</div>";
            header('location: ../dashboard-update-listing');
        }
    }
    //}
    // if listing is successful updated go to dashboard 'view listings' page and print success message
    $_SESSION["successMessage"] = "<div class='success-message'>Listing was successfully updated.</div>";   //with ID: " . $update_listing_id . "
    header('location: ../dashboard-view-listings');

// close db connection
//$mysqli->close();

} else {
    header('Location: ../dashboard-update-listing.php');
}

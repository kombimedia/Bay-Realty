<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Valid entry for Sales Agent
    $valid_agent = true;
    // Check that the field has an entry
    if (empty($_POST['salesAgent'])) {
        $_SESSION["agentError"] = "<div class='validate-error-message'>Oops... Please select an Agent.</div>";
        $valid_agent = false;
    } else {
        $_SESSION["storeSalesAgent"] = $_POST['salesAgent'];
    }

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
    // Check that the field has an entry
    if (empty($_POST['city'])) {
        $_SESSION["cityError"] = "<div class='validate-error-message'>Oops... Please select a City.</div>";
        $valid_city = false;
    } else {
        $_SESSION["storeCity"] = $_POST['city'];
    }

    // Valid entry Property Type
    $valid_type = true;
    // Check that the field has an entry
    if (empty($_POST['propertyType'])) {
        $_SESSION["typeError"] = "<div class='validate-error-message'>Oops... Please select a Property Type.</div>";
        $valid_type = false;
    } else {
        $_SESSION["storePropertyType"] = $_POST['propertyType'];
    }

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
    if (strlen($_POST['saleMethod']) > 24) {
          $_SESSION["sMethodError"] = "<div class='validate-error-message'>Oops... Sale Method must be max 24 characters.</div>";
          $valid_sale_method = false;
    }

    // Valid entry Bedrooms
    $valid_bedrooms = true;
    // Check that the field has an entry
    if (empty($_POST['bedrooms'])) {
        $_SESSION["bedError"] = "<div class='validate-error-message'>Oops... Please select a number of Bedrooms.</div>";
        $valid_bedrooms = false;
    } else {
        $_SESSION["storeBedrooms"] = $_POST['bedrooms'];
    }

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
    // Check that the field has an entry
    if (empty($_POST['bathrooms'])) {
        $_SESSION["bathError"] = "<div class='validate-error-message'>Oops... Please select a number of Bathrooms.</div>";
        $valid_bathrooms = false;
    } else {
        $_SESSION["storeBathrooms"] = $_POST['bathrooms'];
    }

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
    // Check that the field has an entry
    if (empty($_POST['lounges'])) {
        $_SESSION["loungeError"] = "<div class='validate-error-message'>Oops... Please select a number of Lounges.</div>";
        $valid_lounges = false;
    } else {
        $_SESSION["storeLounges"] = $_POST['lounges'];
    }

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
    // Check that the field has an entry
    if (empty($_POST['garages'])) {
        $_SESSION["garageError"] = "<div class='validate-error-message'>Oops... Please select a number of Garages.</div>";
        $valid_garages = false;
    } else {
        $_SESSION["storeGarages"] = $_POST['garages'];
    }

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

    // Validate image(s) and store in the temp folder until we need to use them
    $valid_image = true;
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

        // Validate image before storing to temp folder
        // Limit file size to less than 500kb
        if (($image_size < 500001) && in_array($image_type, $validextensions)) {

            // Save image files to images/uploads folder
            if (!move_uploaded_file($image_tmp, $file_path)) {
                // if file was not moved throw error message
                $_SESSION["imgUploadError"] = "<div class='validate-error-message'>Uh oh... Image(s) were not saved to temp folder.</div>";
                $valid_image = false;
            }
            // if file size or file type were incorrect throw error message
        } else {
                $_SESSION["imgFileError"] = "<div class='validate-error-message'>Oops... Please upload an image max 500kb, jpg, jpeg or png.</div>";
                $valid_image = false;
              }
    }
             // $_SESSION["imgError"] = "<div class='validate-error-message'>Please select at least one image.</div>";
             // $valid_image = false;
}

$valid_listing = $valid_agent && $valid_title && $valid_address && $valid_city && $valid_type && $valid_price && $valid_sale_method && $valid_bedrooms && $valid_bed_des && $valid_bathrooms && $valid_bath_des && $valid_lounges && $valid_lounge_des && $valid_garages && $valid_garage_des && $valid_h_size && $valid_l_size && $valid_map && $valid_prop_des && $valid_image;

if ($valid_listing) {
    header('Location: process-add-listing.php');
} else {
    header('Location: ../dashboard-add-listing.php');
}

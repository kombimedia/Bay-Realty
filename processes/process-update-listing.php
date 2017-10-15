<?php
session_start();
if (isset($_POST['submit'])) {

    include '../includes/db-connect.php';

    // Get listing ID and save to a variable
    $update_listing_id = $_SESSION["update_listing_id"];

    // Set featured listing boolean
    if (isset($_POST['updateFListing'])) {
        $featured_listing = 1;
    } else {
        $featured_listing = 0;
    }

    // Update existing listing in database
    $stmt = $mysqli->prepare("UPDATE properties SET agents = ?, title = ?, address = ?, categories = ?, type = ?, price = ?, sell_method = ?, property_des = ?, bed_no = ?, bed_des = ?, bath_no = ?, bath_des = ?, lounge_no = ?, lounge_des = ?, garage_no = ?, garage_des = ?, house_size = ?, land_size = ?, map_co_ords = ?, featured_image = ?, featured_property = ? WHERE listing_id = ?");
    $stmt->bind_param("issiidssisisisisssssii", $_POST["updateSalesAgent"], $_POST["updateListingTitle"], $_POST["updateStreetAddress"], $_POST["updateCity"], $_POST["updatePropertyType"], $_POST["updatePrice"], $_POST["updateSaleMethod"], $_POST["updatePropDes"], $_POST["updateBedrooms"], $_POST["updateBedDescription"], $_POST["updateBathrooms"], $_POST["updateBathDescription"], $_POST["updateLounges"], $_POST["updateLoungeDescription"], $_POST["updateGarages"], $_POST["updateGarageDescription"], $_POST["updateHouseSize"], $_POST["updateLandSize"], $_POST["updateMapCoord"], $_POST["updateFImage"], $featured_listing, $update_listing_id);
    if (!$stmt->execute()) {
          $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
          //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
          $stmt->close();
          header('location: ../dashboard-update-listing');
          exit;
    }
    $stmt->close();

    //if ($_FILES['file']['name'] != "") {
        // Upload more image(s) to listing
        // loop through images array to get individual element - name, extension
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
            // Rename image and path to include property listing_id
            $image_name = $update_listing_id . '_' . $image_name;
            // Get image size
            $image_size = $_FILES['file']['size'][$i] . 'B';
            // Declare path for uploaded images
            $file_path = "../images/uploads/".$image_name;
            // Validate image before storing to folder and DB
            // Limit file size to less than 500kb
            if (($image_size < 500001) && in_array($image_type, $validextensions)) {

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

                // Save image files to images/uploads folder
                if (!move_uploaded_file($image_tmp, $file_path)) {
                    // if file was not moved throw error message
                    $_SESSION["imgUploadError"] = "<div class='validate-error-message'>Uh oh... Image(s) were not saved to the uploads folder.</div>";
                    header('location: ../dashboard-update-listing');
                }
                // if file size or file type were incorrect throw error message
            } else {
                $_SESSION["imgFileError"] = "<div class='validate-error-message'>Oops... Image should be max 500kb and a jpg, jpeg or png.</div>";
                //$_SESSION["imgFileError"] = var_dump(!isset($_FILES['file']['name']));
                header('location: ../dashboard-update-listing');
              }
        }
    //}
    // if listing is successful updated go to dashboard 'view listings' page and print success message
    $_SESSION["successMessage"] = "<div class='success-message'>Listing with ID: " . $update_listing_id . " was successfully updated.</div>";
    header('location: ../dashboard-view-listings');
}
// close db connection
$mysqli->close();



    // Get form data and save to variables
    // $sales_agent = $_POST["updateSalesAgent"];
    // $listing_title = $_POST["updateListingTitle"];
    // $address = $_POST["updateStreetAddress"];
    // $city = $_POST["updateCity"];
    // $type = $_POST["updatePropertyType"];
    // $price = $_POST["updatePrice"];
    // $sell_method = $_POST["updateSaleMethod"];
    // $bedrooms = $_POST["updateBedrooms"];
    // $bed_des = $_POST["updateBedDescription"];
    // $bathrooms = $_POST["updateBathrooms"];
    // $bath_des = $_POST["updateBathDescription"];
    // $lounges = $_POST["updateLounges"];
    // $lounge_des = $_POST["updateLoungeDescription"];
    // $garages = $_POST["updateGarages"];
    // $garage_des = $_POST["updateGarageDescription"];
    // $house_size = $_POST["updateHouseSize"];
    // $land_size = $_POST["updateLandSize"];
    // $map_co_ords = $_POST["updateMapCoord"];
    // $property_des = $_POST["updatePropDes"];
    // $featured_image = $_POST["updateFImage"];

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




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
$propDes = ($_POST['propDes']);
$fImage = ($_POST['updateFImage']);
$fListing = ($_POST['updateFListing']);

// Insert new listing into database
$addData = "UPDATE properties
            SET agents = '$agent', title = '$lTitle', address = '$address', categories = '$city', type = '$type', price = '$price', sell_method = '$sMethod', property_des = '$propDes', bed_no = '$bedrooms', bed_des = '$bedD', bath_no = '$bathrooms', bath_des = '$bathD', lounge_no = '$lounges', lounge_des = '$loungeD', garage_no = '$garages', garage_des = '$garageD', house_size = '$houseSize', land_size = '$landSize', map_co_ords = '$map', featured_image = '$fImage', featured_property = '$fListing'
            WHERE listing_id = $update_listing_id";
    // if insert is successful go back to dashboard view listing page and print success message
    if ($mysqli->query($addData)) {
        $_SESSION["updateListingSuccess"] = "<div class='success-message'>Listing updated successfully</div>";
    }  else {
      // if insert is unsuccessful throw error
        $_SESSION["updateListingError"] = "<div class='error-message'>Something went wrong! Please try again</div>";
       //$_SESSION["updateListingError"] = "<div class='error-message'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
       }

// Upload new image(s) to listing
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
    $image_size = $_FILES['file']['size'][$i] . 'KB';
    // Declare path for uploaded images
    $file_path = "../images/uploads/".$image_name;
    // Validate image before storing to folder and DB
    // Limit file size to less than 500kb
    if (($image_size < 500001) && in_array($image_type, $validextensions)) {

            $addDat1 = "INSERT INTO images (img_name, img_size, img_type, listing_id)
                        VALUES ('$image_name', '$image_size', '$image_type', '$update_listing_id')";
            // if insert is successful go back to dashboard add listing page and return success message
            if ($mysqli->query($addDat1)) {
                $_SESSION["dbSuccess"] = "<div class='success-message'>New listing successfully created</div>";
            }  else {
              // if insert is unsuccessful throw error
               $_SESSION["dbError"] = "<div class='error-message'>Something went wrong! Please check that all fields have been filled correctly</div>";
              //$_SESSION["dbError"] = "<div class='error-message'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
               }

               // Save image files to images/uploads folder
            if (move_uploaded_file($image_tmp, $file_path)) {
                // if image is moved to uploads folder return success message
                //$_SESSION["imageSuccess"] = "<div class='success-message'>Image(s) successfully uploaded</div>";
                // if file was not moved throw error message
            } else {
                $_SESSION["imageError"] = "<div class='error-message'>Image(s) were not moved to uploads folder</div>";
            }
            // if file size or file type were incorrect throw error message
        } else {
            $_SESSION["imageError"] = "<div class='error-message'>Invalid file size or type</div>";
        }
}

// close db connection
$mysqli->close();
header('location: ../dashboard-view-listings');




<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
    $stmt->bind_param("issiidssssssssssssssii", $_POST["updateSalesAgent"], $_POST["updateListingTitle"], $_POST["updateStreetAddress"], $_POST["updateCity"], $_POST["updatePropertyType"], $_POST["updatePrice"], $_POST["updateSaleMethod"], $_POST["updatePropDes"], $_POST["updateBedrooms"], $_POST["updateBedDescription"], $_POST["updateBathrooms"], $_POST["updateBathDescription"], $_POST["updateLounges"], $_POST["updateLoungeDescription"], $_POST["updateGarages"], $_POST["updateGarageDescription"], $_POST["updateHouseSize"], $_POST["updateLandSize"], $_POST["updateMapCoord"], $_POST["updateFImage"], $featured_listing, $update_listing_id);
    if (!$stmt->execute()) {
          $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
          //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
          $stmt->close();
          header('location: ../dashboard-update-listing');
          exit;
    }
    $stmt->close();

    if (isset($_FILES['file'])) {
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
            $image_size = $_FILES['file']['size'][$i];
            // Declare path for uploaded images
            $file_path = "../images/uploads/".$image_name;
            // Validate image before storing to folder and DB
            // Limit file size to less than 500kb
            if (($image_size < 500001) && in_array($image_type, $validextensions)) {

                $stmt = $mysqli->prepare("INSERT INTO images (img_name, img_size, img_type, listing_id) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("sssi", $image_name, $image_size, $image_type, $update_listing_id);
                // if insert execution is unsuccessful throw error
                if (!$stmt->execute()) {
                      $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
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
                $_SESSION["errorMessage"] = "<div class='error-message'>Oops... Image wasn't uploaded to listing ID: " . $update_listing_id . ". Should be max 500kb and a jpg, jpeg or png. Please try again with a smaller image.</div>";
                header('location: ../dashboard-view-listing');
              }
        }
    }
    // if listing is successfully updated go to dashboard 'view listings' page and print success message
    $_SESSION["successMessage"] = "<div class='success-message'>Listing with ID: " . $update_listing_id . " was successfully updated.</div>";
    header('location: ../dashboard-view-listings');
}
// close db connection
$mysqli->close();

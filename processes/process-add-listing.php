<?php
session_start();
if (isset($_POST['submit'])) {

    include '../includes/db-connect.php';
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

    // Insert new listing into database
    $stmt = $mysqli->prepare("INSERT INTO properties (agents, title, address, categories, type, price, sell_method, property_des, bed_no, bed_des, bath_no, bath_des, lounge_no, lounge_des, garage_no, garage_des, house_size, land_size, map_co_ords, featured_property) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issiidssisisisissssi", $_POST['salesAgent'], $_POST['listingTitle'], $_POST['streetAddress'], $_POST['city'], $_POST['propertyType'], $_POST['price'], $_POST['saleMethod'], $_POST['propDes'], $_POST['bedrooms'], $_POST['bedDescription'], $_POST['bathrooms'], $_POST['bathDescription'], $_POST['lounges'], $_POST['loungeDescription'], $_POST['garages'], $_POST['garageDescription'], $_POST['houseSize'], $_POST['landSize'], $_POST['mapCoord'], $_POST['fListing']);
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
        // Rename image and path to include property listing_id
        $image_name = $new_listing_id . '_' . $image_name;
        // Get image size
        $image_size = ($_FILES['file']['size'][$i]). 'B';
        // Declare path for uploaded images
        $file_path = "../images/uploads/" . $image_name;
        // Validate image before storing to folder and DB
        // Limit file size to less than 500kb
        if (($image_size < 500001) && in_array($image_type, $validextensions)) {

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

            // Save image files to images/uploads folder
            if (!move_uploaded_file($image_tmp, $file_path)) {
                // if file was not moved throw error message
                $_SESSION["errorMessage"] = "<div class='error-message'>Image(s) were not saved to uploads folder</div>";
                header('location: ../dashboard-add-listing');
                exit;
            }
            // if file size or file type were incorrect throw error message
        } else {
            $_SESSION["errorMessage"] = "<div class='error-message'>Invalid file size or type</div>";
          }
    }
    // if listing is successful created go back to dashboard 'add listing' page and print success message
    $_SESSION["successMessage"] = "<div class='success-message'>New listing successfully created. New listing ID is: " . $new_listing_id . "</div>";

    header('location: ../dashboard-add-listing');
}
// close db connection
$mysqli->close();




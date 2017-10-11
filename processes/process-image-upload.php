<?php
session_start();
include '../includes/db-connect.php';

// Get the listing_id of the newly created property listing
// $getListingID = "SELECT listing_id
//                  FROM properties
//                  ORDER BY listing_id
//                  DESC LIMIT 0,1";
// $result = $mysqli->query($getListingID);
// $row = $result->fetch_assoc();
//$listing_id = $row['listing_id'];
$listing_id = $_SESSION["new_listing_id"];
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
        $image_name = $listing_id . '_' . $image_name;
        // Get image size
        $image_size = ($_FILES['file']['size'][$i]). 'B';
        // Declare path for uploaded images
        $file_path = "../images/uploads/" . $image_name;
        // Validate image before storing to folder and DB
        // Limit file size to less than 500kb
        if (($image_size < 500001) && in_array($image_type, $validextensions)) {

                $addData = "INSERT INTO images (img_name, img_size, img_type, listing_id)
                            VALUES ('$image_name', '$image_size', '$image_type', '$listing_id')";
                // if insert is successful go back to dashboard add listing page and return success message
                if ($mysqli->query($addData)) {
                    //$_SESSION["dbSuccess"] = "<div class='success-message'>New listing successfully created</div>";
                }  else {
                  // if insert is unsuccessful throw error
                   $_SESSION["dbError"] = "<div class='error-message'>Something went wrong! Please check that all fields have been filled correctly</div>";
                  //$_SESSION["dbError"] = "<div class='error-message'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
                   }

                // Add featured image file name to the properties table, featured_image
                $addData1 = "UPDATE properties
                             SET featured_image = '$image_name'
                             WHERE listing_id = $listing_id";
                if ($mysqli->query($addData1)) {
                    // $_SESSION["imageSuccess"] = "<div class='success-message'>Properties table update</div>";
                }  else {
                  // if update is unsuccessful throw error
                   $_SESSION["imageError"] = "<div class='error-message'>Something went wrong! Properties table was not updated</div>";
                  // $_SESSION["dbError"] = "<div class='error-message'>An error has occurred: " . $addData1 . " " . $mysqli->error . "</div>";
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
?>

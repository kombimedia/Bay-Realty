<?php
session_start();
include '../includes/db-connect.php';
//Get the listing_id of the newly created property listing
$getListingID = "SELECT listing_id FROM properties ORDER BY listing_id DESC LIMIT 0,1";
$result = $mysqli->query($getListingID);
$row = $result->fetch_assoc();
$listing_id = $row['listing_id'];

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
    $image_size = $_FILES['file']['size'][$i];
    // Store images listing_id to a session to use as reference in 'process-add-listing.php'
    $_SESSION["images"] = $listing_id;
    // Declare path for uploaded images
    $file_path = "../images/uploads/".$image_name;

    // Validate image before storing to folder and DB
    // Limit file size to less than 500kb
    if (($image_size < 500001) && in_array($image_type, $validextensions)) {

            $addData = "INSERT INTO images (img_name, img_size, img_type, listing_id)
            VALUES ('$image_name', '$image_size', '$image_type', '$listing_id')";
            // if insert is successful go back to dashboard add listing page and return success message
            if ($mysqli->query($addData)) {
                $_SESSION["dbSuccess"] = "<div class='db-success'>New listing successfully created</div>";
                //echo '<span class="db-success">Your listing was created successfully</span><br/><br/>';
            }  else {
              // if insert is unsuccessful throw error
               $_SESSION["dbError"] = "<div class='db-error'>Something went wrong! Please check that all fields have been filled correctly</div>";
               //echo '<span class="db-error">Something went wrong! Please check that all fields have been filled correctly</span><br/><br/>';
              //$_SESSION["dbError"] = "<div class='db-error'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
               }

               // Save image files to images/uploads folder
            if  (move_uploaded_file($image_tmp, $file_path)) {
                // if image is moved to uploads folder return success message
                $_SESSION["imageSuccess"] = "<div class='image-success'>Image(s) successfully uploaded</div>";
                // echo '<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                // if file was not moved throw error message
            } else {
                $_SESSION["imageError"] = "<div class='image-error'>Please try again...</div>";
                // echo '.<span id="error">please try again!.</span><br/><br/>';
            }
            // if file size and file type was incorrect throw error message
        } else {
            $_SESSION["imageError"] = "<div class='image-error'>Invalid file size or type</div>";
            // echo '<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
  // close db connection
  $mysqli->close();
?>

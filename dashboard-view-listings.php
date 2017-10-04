<?php
session_start();
$title = "View Listings";
$metaD = "Admin dashboard page, view listings";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
?>

  <h1>View Listing</h1>

  <div id="formdiv">
      <h2>Multiple Image Upload Form</h2>

      <div><?php if (isset($_SESSION['imageSuccess'])) { echo $_SESSION['imageSuccess']; unset($_SESSION['imageSuccess']); }; ?></div>
      <div><?php if (isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; unset($_SESSION['imageError']); }; ?></div>

      <form enctype="multipart/form-data" action="" method="post" enctype="multipart/form-data">
          First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 500KB.
          <hr/>
          <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

          <input type="button" id="add_more" class="upload" value="Add More Files"/>
          <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
      </form>
      <!--Including PHP Script here-->
  </div>

<?php


// // Get the listing_id of the new created property listing
// $getListingID = "SELECT listing_id FROM properties ORDER BY listing_id DESC LIMIT 0,1";
// $result = $mysqli->query($getListingID);
// $row = $result->fetch_assoc();
// $listing_id = $row['listing_id'];

// if (isset($_POST['submit'])) {

//      //Declaring Path for uploaded images
//     for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
//         $validextensions = array('jpeg', 'jpg', 'png');
//         $ext = explode('.', basename($_FILES['file']['name'][$i]));
//         $image_type = end($ext);
//         $image_tmp = $_FILES['file']['tmp_name'][$i];
//         $image_name = $_FILES['file']['name'][$i];
//         $image_name = $listing_id . '_' . $image_name;
//         $image_size = $_FILES['file']['size'][$i];
//         $file_path = "images/uploads/".$image_name;

//     if (($image_size < 500001) && in_array($image_type, $validextensions)) {

//             $addData = "INSERT INTO images (img_name, img_size, img_type, listing_id)
//             VALUES ('$image_name', '$image_size', '$image_type', '$listing_id')";
//             //if insert is successful go back to dashboard add listing page and print success message
//             if ($mysqli->query($addData)) {
//                 //$_SESSION["dbSuccess"] = "<div class='db-success'>New listing successfully created</div>";
//                 echo '<span class="db-success">Your listing was created successfully</span><br/><br/>';
//             }  else {
//               // if insert is unsuccessful throw error
//                //$_SESSION["dbError"] = "<div class='db-error'>Something went wrong! Please check that all fields have been filled correctly</div>";
//                //echo '<span class="db-error">Something went wrong! Please check that all fields have been filled correctly</span><br/><br/>';
//               $_SESSION["dbError"] = "<div class='db-error'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";
//                }

//                // if image is moved to uploads folder
//             if  (move_uploaded_file($image_tmp, $file_path)) {
//                 $_SESSION["imageSuccess"] = "<div class='image-success'>Image(s) successfully uploaded</div>";
//                 //echo '<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
//             } else { //if file was not moved.
//                 $_SESSION["imageError"] = "<div class='image-error'>Please try again...</div>";
//                 //echo '.<span id="error">please try again!.</span><br/><br/>';
//             }
//         } else { //if file size and file type was incorrect.
//             $_SESSION["imageError"] = "<div class='image-error'>Invalid file size or type</div>";
//             //echo '<span id="error">***Invalid file Size or Type***</span><br/><br/>';
//         }
//     }
//   // close db connection
//   $mysqli->close();
// }

?>






<?php
  include 'processes/process-image-upload.php';
  include 'includes/dashboard-footer.php';
?>


<?php

// if (isset($_POST['submit'])) {
// // Variable for indexing uploaded image.
// $j = 0;
// // Declaring Path for uploaded images.
// $target_path = "uploads/test/";

// // Loop to get individual element from the array
// for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

//     // Extensions which are allowed.
//     $validextensions = array("jpeg", "jpg", "png");

//     // Explode file name from dot(.)
//     $ext = explode('.', basename($_FILES['file']['name'][$i]));

//     // Store extensions in the variable.
//     $file_extension = end($ext);
//     // Set the target path with a new name of image.
//     $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];

//     // Increment the number of uploaded images according to the files in array.
//     $j = $j + 1;

//     if (($_FILES["file"]["size"][$i] < 100000) && in_array($file_extension, $validextensions)) {

//         // If file moved to uploads folder.
//         if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {

//             echo '<div id="noerror">Image '.$j.'-->Image Uploaded!</div>';

//             // File was moved, so execute code here
//             //Connection to DB

//             $mysqli = new mysqli("localhost", "my_user", "my_password", "table_name");

//             // check connection
//             if ($mysqli->connect_errno) {
//                 printf("Connect failed: %s\n", $mysqli->connect_error);
//                 exit();
//             }

//             $mysqli->query("INSERT INTO images_table (img_column_1) VALUES ('".$_FILES['file']['tmp_name'][$i]."')");

//             //Close DB connection
//             mysqli_close($con);

//         //  If File Was Not Moved.
//         } else {

//             echo '<div id="error">Image '.$j.'--> <b>Please Try Again!</b></div>';
//         }

//     //If File Size And File Type Was Incorrect.
//     } else {

//         echo '<div id="error">Image '.$j.'--> <b>Check file Size or Type</b></div>';

//     }
// }
// }
?>



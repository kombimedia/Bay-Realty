<?php
  $title = "View Listings";
  $metaD = "Admin dashboard page, view listings";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>View Listing</h1>

  <div id="formdiv">
      <h2>Multiple Image Upload Form</h2>

      <!-- <div><?php if (isset($_SESSION['imageSuccess'])) { echo $_SESSION['imageSuccess']; unset($_SESSION['imageSuccess']); }; ?></div>
      <div><?php if (isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; unset($_SESSION['imageError']); }; ?></div> -->

      <form enctype="multipart/form-data" action="" method="post">
          First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 500KB.
          <hr/>
          <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

          <input type="button" id="add_more" class="upload" value="Add More Files"/>
          <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
      </form>
      <!--Including PHP Script here-->
  </div>


<?php

if (isset($_POST['submit'])) {

    //$j = 0; // Variable for indexing uploaded image
    $target_path = "images/uploads/"; //Declaring Path for uploaded images
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) { //loop to get individual element from the array

        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable
        $image_name = $target_path . (basename($_FILES['file']['name'][$i])); // Set image name to a variable
        $images = ($_FILES['file']['name'][$i]);

        //$target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1]; //set the target path with a new name of image
        //$j = $j + 1; // increment the number of uploaded images according to the files in array

    if (($_FILES["file"]["size"][$i] < 500000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if  (move_uploaded_file($_FILES['file']['tmp_name'][$i], $image_name)) { //if image is moved to uploads folder
                //$_SESSION["imageSuccess"] = "<div class='image-success'>Image(s) successfully uploaded</div>";
                echo '<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else { //if file was not moved.
                //$_SESSION["imageError"] = "<div class='image-error'>Please try again...</div>";
                echo '.<span id="error">please try again!.</span><br/><br/>';
            }
        } else { //if file size and file type was incorrect.
            //$_SESSION["imageError"] = "<div class='image-error'>Invalid file size or type</div>";
            echo '<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
      }



// // Get property ID
// $sql = "SELECT MAX(id) FROM properties";
// $result = $mysqli->query($sql);
// list($id) = mysql_fetch_row($res);


// Insert new listing into database
$addData = "UPDATE properties SET images = ('$images') WHERE listing_id = 00173";
    // if insert is successful go back to dashboard add listing page and print success message
    if ($mysqli->query($addData)) {
        //$_SESSION["dbSuccess"] = "<div class='db-success'>New listing successfully created</div>";
        echo '<span class="db-success">Your listing was created successfully</span><br/><br/>';

    }  else {
      // if insert is unsuccessful throw error
       //$_SESSION["dbError"] = "<div class='db-error'>Something went wrong! Please check that all fields have been filled correctly</div>";
       echo '<span class="db-error">Something went wrong! Please check that all fields have been filled correctly</span><br/><br/>';
        // $_SESSION["dbError"] = "<div class='db-error'>An error has occurred: " . $addData . " " . $mysqli->error . "</div>";

       }

}
// close db connection
$mysqli->close();
?>

<?php
  //include 'processes/process-image-upload.php';
  include 'includes/dashboard-footer.php';
?>



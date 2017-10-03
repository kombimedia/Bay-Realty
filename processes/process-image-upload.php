<?php
session_start();
//Declaring Path for uploaded images
$target_path = "../images/uploads/";
//loop through images array to get individual element - name, extension
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
    // Accepted extensions
    $validextensions = array('jpeg', 'jpg', 'png');
    // Separate file name from dot(.)
    $ext = explode('.', basename($_FILES['file']['name'][$i]));
    // store extensions to a variable
    $file_extension = end($ext);
    // Set image path and name to a variable
    $image_name = $target_path . (basename($_FILES['file']['name'][$i]));
    // Set image name to a variable
    $images = ($_FILES['file']['name'][$i]);
    // Store image name to a session to use 'process-add-listing.php'
    $_SESSION["images"] = $images;

    // Validate image before storing to folder and DB
    // Limit file size to less than 500kb
    if (($_FILES['file']['size'][$i] < 500000)
                // Check for valid file extensio
                && in_array($file_extension, $validextensions)) {
            // if all ok, image is moved to uploads folder
            if  (move_uploaded_file($_FILES['file']['tmp_name'][$i], $image_name)) {
                $_SESSION["imageSuccess"] = "<div class='image-success'>Image(s) successfully uploaded</div>";
                // echo '<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                // if there is a problem with the move
            } else {
                $_SESSION["imageError"] = "<div class='image-error'>Please try again...</div>";
                // echo '.<span id="error">please try again!.</span><br/><br/>';
            }
            // if file size and file type check fails
        } else {
            $_SESSION["imageError"] = "<div class='image-error'>Invalid file size or type</div>";
            // echo '<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
}

?>

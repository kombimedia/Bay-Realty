<?php
//if (isset($_POST['submit'])) {
    $j = 0; //Variable for indexing uploaded image

  $target_path = "../images/uploads/"; //Declaring Path for uploaded images
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
        $file_extension = end($ext); //store extensions in the variable

    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1; // increment the number of uploaded images according to the files in array

    if (($_FILES["file"]["size"][$i] < 500000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                $_SESSION["imageSuccess"] = "<div class='image-success'>Image(s) successfully uploaded</div>";
                //echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
            } else {//if file was not moved.
                $_SESSION["imageError"] = "<div class='image-error'>Please try again...</div>";
                //echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            $_SESSION["imageError"] = "<div class='image-error'>Invalid file size or type</div>";
            //echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
        //header('location: ../dashboard-add-listing');
    }
//}

?>

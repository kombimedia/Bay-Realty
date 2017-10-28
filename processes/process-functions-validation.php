<?php
//--------------  USER / AGENT INPUTS ----------------------------------

// Validate name
function validate_name ($name, $error, $message) {
     // check if field is populated
    if (empty($name)) {
      $_SESSION["$error"] = "<div class='validate-error-message mb-2'>Your $message is required</div>";
      $validName = false;
      return false;
    } else {
      // check if name contains only letters, a '-' or a space
      if (!preg_match("/^[a-zA-Z -]*$/",$name)) {
        $_SESSION["$error"] = "<div class='validate-error-message mb-2'>Only letters, a hyphen and a space are allowed</div>";
        $validName = false;
        return false;
      }
      // check that name has at least two letters
      if (strlen($name) < 2) {
        $_SESSION["$error"] = "<div class='validate-error-message mb-2'>Your $message must be at least 2 letters</div>";
        $validName = false;
        return false;
      }
    }
    return true;
}

// Validate email address
function validate_email($email) {
    // check if field is populated
    if (empty($email)) {
      $_SESSION["emailError"] = "<div class='validate-error-message mb-2'>Your email is required</div>";
      $validEmail = false;
      return false;
    } else {
      // check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["emailError"] = "<div class='validate-error-message mb-2'>Your email is invalid</div>";
        $validEmail = false;
        return false;
      }
    }
    return true;
}

// Validate password
// check if field is populated
function validate_password ($password) {
    if (empty($password)) {
      $_SESSION["passwordError"] = "<div class='validate-error-message mb-2'>A password is required</div>";
      $validPassword = false;
      return false;
    } else {
      // check password meets minimum strength requirement
      if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/",$password)) {
        $_SESSION["passwordError"] = "<div class='validate-error-message mb-2'>Password must be at least 8 characters long, have an uppercase and a lowercase letter, a number and a special character</div>";
        $validPassword = false;
        return false;
      }
    }
    return true;
}

// Validate phone number
function validate_phone ($phone) {
    // Check that the field has an entry
    if (empty($phone)) {
        $_SESSION["phoneError"] = "<div class='validate-error-message mb-2'>Your phone number is required.</div>";
        $validPhone = false;
        return false;
    // Check that phone number meets defined format and character set
    } elseif (!preg_match('/^(\(0\d\)\d{7}|\(02\d\)\d{6,8}|0800\s\d{5,8})$/', ($phone))) {
        $_SESSION["phoneError"] = "<div class='validate-error-message mb-2'>Oops... Please enter a valid phone number - (021)1234567.</div>";
        $validPhone = false;
        return false;
        }
        $validPhone = true;
        return true;
}

//--------------  PROPERTY LISTINGS ----------------------------------

// Validate Price
function validate_price ($price) {
    // Check that the field has an entry
    if (empty($price)) {
        $_SESSION["priceError"] = "<div class='validate-error-message mb-2'>Oops... Please enter a price.</div>";
        $valid_price = false;
        return false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $price)) {
          $_SESSION["priceError"] = "<div class='validate-error-message mb-2'>Oops... Price must be a number only -  No ($ or , or .).</div>";
          $valid_price = false;
          return false;
    }
    $valid_price = true;
    return true;
}

// Valid Sale Method
function validate_sale_method ($sale_method) {
    // Check the string length is not more than the db limit - varchar(24)
    if (strlen($sale_method) > 24) {
          $_SESSION["sMethodError"] = "<div class='validate-error-message mb-2'>Oops... Sale method must be max 24 characters.</div>";
          $valid_sale_method = false;
          return false;
    }
    $valid_sale_method = true;
    return true;
}

// Validate Property Size
function validate_property_size($name, $error, $valid, $message) {
    // Check that the field has an entry
    if (empty($name)) {
        $_SESSION["$error"] = "<div class='validate-error-message mb-2'>Oops... Please enter a " . $message . ".</div>";
        $valid = false;
        return false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $name)) {
          $_SESSION["$error"] = "<div class='validate-error-message mb-2'>Oops... " . $message . " must be a number only.</div>";
          $valid = false;
          return false;
    }
    $valid = true;
    return true;
}

// Validate Text Input Field
function validate_input_field($name, $error, $valid, $message, $char_limit) {
    // Check that the field has an entry
    if (empty($name)) {
        $_SESSION["$error"] = "<div class='validate-error-message mt-2 mb-2'>Oops... Please enter a $message.</div>";
        $valid = false;
        return false;
    // Check the string length is not more than the defined number of characters
    } elseif (strlen($name) > $char_limit) {
          $char_count = strlen($name);
          $_SESSION["$error"] = "<div class='validate-error-message mt-2 mb-2'>Oops... " . $message . " must be max " . $char_limit . " characters. You currently have " . $char_count . " characters.</div>";
          $valid = false;
          return false;
    }
    $valid = true;
    return true;
}

// Validate image(s) and store in the temp folder until we need to use them
function validate_image_temp_folder($files) {
    // loop through images array to get individual element - name, extension
    for ($i = 0; $i < count($files['name']); $i++) {
        // Accepted extensions
        $validextensions = array('jpeg', 'jpg', 'png');
        // Separate file name from dot(.)
        $ext = explode('.', basename($files['name'][$i]));
        // Store extensions to a variable
        $image_type = end($ext);
        // Temporary file storage location path
        $image_tmp = $files['tmp_name'][$i];
        // Set image name
        $image_name = $files['name'][$i];
        // Get image size
        $image_size = ($files['size'][$i]);
        // Declare path for temp images
        $file_path = "../images/temp/" . $image_name;

        // Validate image before storing to temp folder
        // Limit file size to less than 500kb
        if (($image_size < 500001) && in_array($image_type, $validextensions)) {

            // Save image files to temp folder
            if (!move_uploaded_file($image_tmp, $file_path)) {
                // if file was not moved throw error message
                $_SESSION["imgUploadError"] = "<div class='validate-error-message mb-2'>Uh oh... Image(s) were not saved to uploads folder.</div>";
                $valid_image = false;
                return false;
            }
            // if file size or file type were incorrect throw error message
        } else {
                $_SESSION["imgFileError"] = "<div class='validate-error-message mb-2'>Oops... Please upload an image max 500kb, jpg, jpeg or png.</div>";
                $valid_image = false;
                return false;
              }
    }
             // $_SESSION["imgError"] = "<div class='validate-error-message mb-2'>Please select at least one image.</div>";
             // $valid_image = false;
    $valid_image = true;
    return true;
}


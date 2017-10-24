<?php
//--------------  USER LOGIN ----------------------------------
// Validate first name
function validate_first_name ($name) {
     // check if field is populated
    if (empty($name)) {
      $_SESSION["firstNameError"] = "<div class='validate-error-message'>Your first name is required</div>";
      $validName = false;
      return false;
    } else {
      // check if name contains only letters, a '-' or a space
      if (!preg_match("/^[a-zA-Z -]*$/",$name)) {
        $_SESSION["firstNameError"] = "<div class='validate-error-message'>Only letters, a hyphen and a space are allowed</div>";
        $validName = false;
        return false;
      }
      // check that name has at least two letters
      if (strlen($name) < 2) {
        $_SESSION["firstNameError"] = "<div class='validate-error-message'>Your name must be at least 2 letters</div>";
        $validName = false;
        return false;
      }
    }
    return true;
}

// Validate surname
function validate_surname ($surname) {
    // check if field is populated
    if (empty($surname)) {
      $_SESSION["surnameError"] = "<div class='validate-error-message'>Your surname is required</div>";
      $validSName = false;
      return false;
    } else {
      // check if name contains only letters, a '-' or a space
      if (!preg_match("/^[a-zA-Z -]*$/",$surname)) {
        $_SESSION["surnameError"] = "<div class='validate-error-message'>Only letters, a hyphen and a space are allowed</div>";
        $validSName = false;
        return false;
      }
      // check that name has at least two letters
      if (strlen($surname) < 2) {
        $_SESSION["surnameError"] = "<div class='validate-error-message'>Your surname must be at least 2 letters</div>";
        $validSName = false;
        return false;
      }
    }
    return true;
}

// Validate email address
function validate_email($email) {
    // check if field is populated
    if (empty($email)) {
      $_SESSION["emailError"] = "<div class='validate-error-message'>Your email is required</div>";
      $validEmail = false;
      return false;
    } else {
      // check if email is valid
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["emailError"] = "<div class='validate-error-message'>Your email is invalid</div>";
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
      $_SESSION["passwordError"] = "<div class='validate-error-message'>A password is required</div>";
      $validPassword = false;
      return false;
    } else {
      // check password meets minimum strength requirement
      if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/",$password)) {
        $_SESSION["passwordError"] = "<div class='validate-error-message'>Password must be at least 8 characters long, have an uppercase and a lowercase letter, a number and a special character</div>";
        $validPassword = false;
        return false;
      }
    }
    return true;
}

// // Validate user role
// function validate_user_role ($role) {
//     if (empty($role)) {
//         $_SESSION["userRoleError"] = "<div class='validate-error-message'>A User Role is required</div>";
//         $validRole = false;
//         return false;
//     } else {
//         $validRole = true;
//     }
//     return true;
// }

//--------------  PROPERTY LISTINGS ----------------------------------
// // Validate Sales Agent
// function validate_sales_agent ($sales_agent) {
//     // Check that the field has an entry
//     if (empty($sales_agent)) {
//         $_SESSION["agentError"] = "<div class='validate-error-message'>Oops... Please select an Agent.</div>";
//         $valid_agent = false;
//         return false;
//     } else {
//         $valid_agent = true;
//     }
//     return true;
// }

// Validate Listing Title
function validate_listing_title ($listing_title) {
    // Check that the field has an entry
    if (empty($listing_title)) {
        $_SESSION["titleError"] = "<div class='validate-error-message'>Oops... Please enter a listing title.</div>";
        $valid_title = false;
        return false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($listing_title) > 55) {
          $_SESSION["titleError"] = "<div class='validate-error-message'>Oops... Listing title must be max 55 characters.</div>";
          $valid_title = false;
          return false;
    }
    $valid_title = true;
    return true;
}

 // Validate Street Address
function validate_street_address ($street_address) {
    // Check that the field has an entry
    if (empty($street_address)) {
        $_SESSION["addressError"] = "<div class='validate-error-message'>Oops... Please enter a Street Address.</div>";
        $valid_address = false;
        return false;
        // Check the string length is not more than 255 characters
    } elseif (strlen($street_address) > 255) {
          $_SESSION["addressError"] = "<div class='validate-error-message'>Oops... Street address must be max 255 characters.</div>";
          $valid_address = false;
          return false;
    }
    $valid_address = true;
    return true;
}

// Validate Price
function validate_price ($price) {
    // Check that the field has an entry
    if (empty($price)) {
        $_SESSION["priceError"] = "<div class='validate-error-message'>Oops... Please enter a Price.</div>";
        $valid_price = false;
        return false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $price)) {
          $_SESSION["priceError"] = "<div class='validate-error-message'>Oops... Price must be a number only -  No ($ or , or .).</div>";
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
          $_SESSION["sMethodError"] = "<div class='validate-error-message'>Oops... Sale Method must be max 24 characters.</div>";
          $valid_sale_method = false;
          return false;
    }
    $valid_sale_method = true;
    return true;
}

// Validate Bedroom Description
function validate_bedroom_description ($bedroom_description) {
    // Check that the field has an entry
    if (empty($bedroom_description)) {
        $_SESSION["bedDesError"] = "<div class='validate-error-message'>Oops... Please enter a Bedroom Description.</div>";
        $valid_bed_des = false;
        return false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($bedroom_description) > 55) {
          $_SESSION["bedDesError"] = "<div class='validate-error-message'>Oops... Bedroom Description must be max 55 characters.</div>";
          $valid_bed_des = false;
          return false;
    }
    $valid_bed_des = true;
    return true;
}

// Validate Bathroom Description
function validate_bathroom_description ($bathroom_description) {
    // Check that the field has an entry
    if (empty($bathroom_description)) {
        $_SESSION["bathDesError"] = "<div class='validate-error-message'>Oops... Please enter a Bathroom Description.</div>";
        $valid_bath_des = false;
        return false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($bathroom_description) > 55) {
          $_SESSION["bathDesError"] = "<div class='validate-error-message'>Oops... Bathroom Description must be max 55 characters.</div>";
          $valid_bath_des = false;
          return false;
    }
    $valid_bath_des = true;
    return true;
}

// Validate Lounge Description
function validate_lounge_description($lounge_description) {
    // Check that the field has an entry
    if (empty($lounge_description)) {
        $_SESSION["loungeDesError"] = "<div class='validate-error-message'>Oops... Please enter a Lounge Description.</div>";
        $valid_lounge_des = false;
        return false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($lounge_description) > 55) {
          $_SESSION["loungeDesError"] = "<div class='validate-error-message'>Oops... Lounge Description must be max 55 characters.</div>";
          $valid_lounge_des = false;
          return false;
    }
    $valid_lounge_des = true;
    return true;
}

// Validate Garage Description
function validate_garage_description($garage_description) {
    // Check that the field has an entry
    if (empty($garage_description)) {
        $_SESSION["garageDesError"] = "<div class='validate-error-message'>Oops... Please enter a Garage Description.</div>";
        $valid_garage_des = false;
        return false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($garage_description) > 55) {
          $_SESSION["garageDesError"] = "<div class='validate-error-message'>Oops... Garage Description must be max 55 characters.</div>";
          $valid_garage_des = false;
          return false;
    }
    $valid_garage_des = true;
    return true;
}

// Validate House Size
function validate_house_size($house_size) {
    // Check that the field has an entry
    if (empty($house_size)) {
        $_SESSION["hSizeError"] = "<div class='validate-error-message'>Oops... Please enter a House Size.</div>";
        $valid_h_size = false;
        return false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $house_size)) {
          $_SESSION["hSizeError"] = "<div class='validate-error-message'>Oops... House Size must be a number only.</div>";
          $valid_h_size = false;
          return false;
    }
    $valid_h_size = true;
    return true;
}

// Validate Land Size
function validate_land_size($land_size) {
    // Check that the field has an entry
    if (empty($land_size)) {
        $_SESSION["lSizeError"] = "<div class='validate-error-message'>Oops... Please enter a Land Size.</div>";
        $valid_l_size = false;
        return false;
        // Check the value is a valid number
    } elseif (!preg_replace('/[^0-9]/', '', $land_size)) {
          $_SESSION["lSizeError"] = "<div class='validate-error-message'>Oops... Land Size must be a number only.</div>";
          $valid_l_size = false;
          return false;
    }
    $valid_l_size = true;
    return true;
}

// Validate Map Co-ordinates
function validate_map_coords($map_coords) {
    // Check that the field has an entry
    if (empty($map_coords)) {
        $_SESSION["mapCoordError"] = "<div class='validate-error-message'>Oops... Please enter valid Map Co-ordinates.</div>";
        $valid_map = false;
        return false;
        // Check the string length is not more than the db limit - varchar(55)
    } elseif (strlen($map_coords) > 55) {
          $_SESSION["mapCoordError"] = "<div class='validate-error-message'>Oops... Map Co-ordinates must be max 55 characters.</div>";
          $valid_map = false;
          return false;
    }
    $valid_map = true;
    return true;
}

// Validate Property Description
function validate_property_description($property_description) {
    // Check that the field has an entry
    if (empty($property_description)) {
        $_SESSION["propDesError"] = "<div class='validate-error-message'>Oops... Please enter a Property Description.</div>";
        $valid_prop_des = false;
        return false;
    // Check the string length is not more than 500 characters
    } elseif (strlen($property_description) > 1000) {
          $char_count = strlen($property_description);
          $_SESSION["propDesError"] = "<div class='validate-error-message'>Oops... Property Description must be max 1000 characters. You currently have " . $char_count . " characters.</div>";
          $valid_prop_des = false;
          return false;
    }
    $valid_prop_des = true;
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
                $_SESSION["imgUploadError"] = "<div class='validate-error-message'>Uh oh... Image(s) were not saved to uploads folder.</div>";
                $valid_image = false;
                return false;
            }
            // if file size or file type were incorrect throw error message
        } else {
                $_SESSION["imgFileError"] = "<div class='validate-error-message'>Oops... Please upload an image max 500kb, jpg, jpeg or png.</div>";
                $valid_image = false;
                return false;
              }
    }
             // $_SESSION["imgError"] = "<div class='validate-error-message'>Please select at least one image.</div>";
             // $valid_image = false;
    $valid_image = true;
    return true;
}

//--------------  ADD AGENT ----------------------------------
// Validate phone number
function validate_phone ($phone) {
    // Check that the field has an entry
    if (empty($phone)) {
        $_SESSION["phoneError"] = "<div class='validate-error-message'>Your phone number is required.</div>";
        $validPhone = false;
        return false;
    // Check the string length is not more than 500 characters
    } elseif (!preg_match('/^(\(0\d\)\d{7}|\(02\d\)\d{6,8}|0800\s\d{5,8})$/', ($phone))) {
      //(!preg_match('/^\(?\+?([0-9]{1,4})\)?[-\. ]?(\d{3})[-\. ]?([0-9]{7})$/', trim($phone)))
      $_SESSION["phoneError"] = "<div class='validate-error-message'>Oops... Please enter a valid phone number - (021)1234567.</div>";
      $validPhone = false;
      return false;
      }
    $validPhone = true;
    return true;
}

// Validate agent Description
function validate_agent_description($agent_description) {
    // Check that the field has an entry
    if (empty($agent_description)) {
        $_SESSION["agentDesError"] = "<div class='validate-error-message'>An Agent description is required.</div>";
        $valid_prop_des = false;
        return false;
    // Check the string length is not more than 500 characters
    } elseif (strlen($agent_description) > 500) {
          $char_count = strlen($agent_description);
          $_SESSION["agentDesError"] = "<div class='validate-error-message'>Oops... Agent Description must be max 500 characters. You currently have " . $char_count . " characters.</div>";
          $valid_prop_des = false;
          return false;
    }
    $valid_prop_des = true;
    return true;
}

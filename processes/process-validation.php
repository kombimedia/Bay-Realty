<?php
// Validate first name
function validate_first_name ($name) {
     // check if field is populated
    if (empty($name)) {
      $error = "<div class='validate-error-message'>Your first name is required</div>";
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

// Validate user role
function validate_user_role ($role) {
    if (empty($role)) {
        $_SESSION["userRoleError"] = "<div class='validate-error-message'>A User Role is required</div>";
        $validRole = false;
        return false;
    } else {
        $validRole = true;
    }
    return true;
}

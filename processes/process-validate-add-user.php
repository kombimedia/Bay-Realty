<?php
session_start();
// Save form data to global variables to repopulate form if submit fails
$_SESSION['storeFirstName'] = $_POST['firstName'];
$_SESSION['storeSurname'] = $_POST['surname'];
$_SESSION['storeEmail'] = $_POST['email'];
$_SESSION['storePassword'] = $_POST['password'];

// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate first name
   $validName = true;
   // check if field is populated
  if (empty($_POST["firstName"])) {
    $_SESSION["firstNameError"] = "<div class='validate-error-message'>Your first name is required</div>";
    $validName = false;
  } else {
    // run function to clean up input strings
    $_POST["firstName"] = test_input($_POST["firstName"]);
    // check if name contains only letters, a '-' or a space
    if (!preg_match("/^[a-zA-Z -]*$/",$_POST["firstName"])) {
      $_SESSION["firstNameError"] = "<div class='validate-error-message'>Only letters, a hyphen and a space are allowed</div>";
      $validName = false;
    }
    // check that name has at least two letters
    if (strlen($_POST["firstName"]) < 2) {
      $_SESSION["firstNameError"] = "<div class='validate-error-message'>Your name must be at least 2 letters</div>";
      $validName = false;
    }
  }

  // Validate surname
  $validSName = true;
  // check if field is populated
  if (empty($_POST["surname"])) {
    $_SESSION["surnameError"] = "<div class='validate-error-message'>Your surname is required</div>";
    $validSName = false;
  } else {
    // run function to clean up input strings
    $_POST["surname"] = test_input($_POST["surname"]);
    // check if name contains only letters, a '-' or a space
    if (!preg_match("/^[a-zA-Z -]*$/",$_POST["surname"])) {
      $_SESSION["surnameError"] = "<div class='validate-error-message'>Only letters, a hyphen and a space are allowed</div>";
      $validSName = false;
    }
    // check that name has at least two letters
    if (strlen($_POST["surname"]) < 2) {
      $_SESSION["surnameError"] = "<div class='validate-error-message'>Your surname must be at least 2 letters</div>";
      $validSName = false;
    }
  }

  // Validate email address
  $validEmail = true;
  // check if field is populated
  if (empty($_POST["email"])) {
    $_SESSION["emailError"] = "<div class='validate-error-message'>Your email is required</div>";
    $validEmail = false;
  } else {
    // run function to clean up input strings
    $email = test_input($_POST["email"]);
    // check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $_SESSION["emailError"] = "<div class='validate-error-message'>Your email is invalid</div>";
      $validEmail = false;
    }
  }

  // Validate password
  $validPassword = true;
  // check if field is populated
  if (empty($_POST["password"])) {
    $_SESSION["passwordError"] = "<div class='validate-error-message'>A password is required</div>";
    $validPassword = false;
  } else {
    // run function to clean up input strings
    $_POST["password"] = test_input($_POST["password"]);
    // check password meets minimum strength requirement
    if (!preg_match("/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/",$_POST["password"])) {
      $_SESSION["passwordError"] = "<div class='validate-error-message'>Password must be at least 8 characters long, have an uppercase and a lowercase letter, a number and a special character</div>";
      $validPassword = false;
    }
  }
  $_POST["password"] = md5($_POST["password"]);

  // Validate user role
  $validRole = true;
  if (empty($_POST["role"])) {
      $_SESSION["userRoleError"] = "<div class='validate-error-message'>A User Role is required</div>";
      $validRole = false;
  } else {
      $validRole = true;
  }

}
// function to clean up input strings before adding to db
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

// If all validation passes set validForm variable to true
$validForm = $validName && $validSName && $validEmail && $validPassword && $validRole;

// Only connect to database if form passes validation
if ($validForm) {
    // Create db connection
    include '../includes/db-connect.php';
    // Check whether email address has already been registered in the database
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        // if email has not previously been registered, add new user details to database
        $stmt1 = $mysqli->prepare("INSERT INTO users (first_name, surname, email, role, password) VALUES (?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssis", $_POST['firstName'], $_POST['surname'], $_POST['email'], $_POST['role'], $_POST['password']);
        if ($stmt1->execute()) {
            header('location: ../dashboard-view-users');
        } else {
          // if insert is unsuccessful throw error
           header('location: ../dashboard-add-user');
           $_SESSION["errorMessage"] = "<div class='error-message'>An error has occurred: " . $stmt->errno . " " . $stmt->error. "</div>";
           }
           $stmt1->close();
    } else {
        // if email already exists in db, throw error
        header('location: ../dashboard-add-user');
        $_SESSION["errorMessage"] = "<div class='error-message'>This email address is already registered</div>";
        exit;
    }
    $stmt->close();
} else {
    // if form does not pass validation redirect back to registration page
    header('Location: ../dashboard-add-user');
    exit;
  }
// if user is successfully created go back to dashboard 'add user' page and print success message
$_SESSION["successMessage"] = "<div class='success-message'>New User successfully created.</div>";
header('location: ../dashboard-add-user');

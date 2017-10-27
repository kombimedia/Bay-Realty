<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'process-functions-validation.php';

// Save form data to global variables to repopulate form if submit fails
$_SESSION['storeguestFirstName'] = $_POST['guestFirstName'];
$_SESSION['storeguestSurname'] = $_POST['guestSurname'];
$_SESSION['storeguestEmail'] = $_POST['guestEmail'];
$_SESSION['storeguestPassword'] = $_POST['guestPassword'];

// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate first name
    $validName = true;
    if (!validate_first_name ($_POST["guestFirstName"])) {
        $validName = false;
    }

    // Validate surname
    $validSName = true;
    if (!validate_surname ($_POST["guestSurname"])) {
        $validSName = false;
    }

    // Validate email address
    $validEmail = true;
    if (!validate_email ($_POST["guestEmail"])) {
        $validEmail = false;
    }

    // // Validate password
    $validPassword = true;
    if (!validate_password ($_POST["guestPassword"])) {
        $validPassword = false;
    }
    $_POST["guestPassword"] = md5($_POST["guestPassword"]);

    // Validate user role
}

// If all validation passes set validForm variable to true
$validForm = $validName && $validSName && $validEmail && $validPassword;

// Only connect to database if form passes validation
if ($validForm) {
    // Create db connection
    include '../includes/db-connect.php';
    // Check whether email address has already been registered in the database
    $stmt = $mysqli->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $_POST["guestEmail"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        $guest_user_role = 3;
        // if email has not previously been registered, add new user details to database
        $stmt1 = $mysqli->prepare("INSERT INTO users (first_name, surname, email, role, password) VALUES (?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssis", $_POST['guestFirstName'], $_POST['guestSurname'], $_POST['guestEmail'], $guest_user_role, $_POST['guestPassword']);
        if (!$stmt1->execute()) {
             
          // if insert is unsuccessful throw error
           header('location: ../guest-register.php');
           $_SESSION["errorMessage"] = "<div class='error-message'>An error has occurred: " . $stmt->errno . " " . $stmt->error. "</div>";
           }
           $stmt1->close();
    } else {
        // if email already exists in db, throw error
        header('location: ../guest-register.php');
        
        $_SESSION["emailError"] = "<div class='validate-error-message'>This email address is already registered</div>";
        exit;
    }
    $stmt->close();
} else {
    // if form does not pass validation redirect back to registration page
    header('Location: ../guest-register.php');
    exit;
  }
// Get the just created listing_id and save to a variable
$new_user_id = mysqli_insert_id($mysqli);

// if user is successfully created go back to dashboard 'add user' page and print success message
$_SESSION["successMessage"] = "<div class='success-message'>New User with ID: " . $new_user_id . " successfully created.</div>";
header('location: ../guest-login.php');

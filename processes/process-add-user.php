<?php
session_start();
include 'process-validation.php';
// Save form data to global variables to repopulate form if submit fails
$_SESSION['storeFirstName'] = $_POST['firstName'];
$_SESSION['storeSurname'] = $_POST['surname'];
$_SESSION['storeEmail'] = $_POST['email'];
$_SESSION['storePassword'] = $_POST['password'];

// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate first name
    $validName = true;
    if (!validate_first_name ($_POST["firstName"])) {
        $validName = false;
    }

    // Validate surname
    $validSName = true;
    if (!validate_surname ($_POST["surname"])) {
        $validSName = false;
    }

    // Validate email address
    $validEmail = true;
    if (!validate_email ($_POST["email"])) {
        $validEmail = false;
    }

    // // Validate password
    $validPassword = true;
    if (!validate_password ($_POST["password"])) {
        $validPassword = false;
    }
    $_POST["password"] = md5($_POST["password"]);

    // Validate user role
    $validRole = true;
    if (!validate_user_role ($_POST["role"])) {
        $validRole = false;
    }
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
// Get the just created listing_id and save to a variable
$new_user_id = mysqli_insert_id($mysqli);

// if user is successfully created go back to dashboard 'add user' page and print success message
$_SESSION["successMessage"] = "<div class='success-message'>New User with ID: " . $new_user_id . " successfully created.</div>";
header('location: ../dashboard-add-user');

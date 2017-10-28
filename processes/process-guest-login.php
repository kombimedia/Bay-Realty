<?php
session_start();
include 'process-functions-validation.php';

if (isset($_POST['submit'])) {
    // Save login email to session to repopulate email field if login fails
    $_SESSION["storeLoginEmail"] = $_POST['loginEmail'];

    // Validate input fields
    // Validate email address
    $validEmail = true;
    if (!validate_email ($_POST["loginEmail"])) {
        $validEmail = false;
    }

    // Validate password
    $validPassword = true;
    if (!validate_password ($_POST['loginPassword'])) {
        $validPassword = false;
    }
    $_POST['loginPassword'] = md5($_POST['loginPassword']);
}

// If all validation passes set valid_login_form variable to true
$valid_Login_form = $validEmail && $validPassword;

// Only connect to database if form passes validation
if ($valid_Login_form) {
    // Create connection
    include '../includes/db-connect.php';
    // get users details from database and save to variables
    $stmt = $mysqli->prepare("SELECT role, first_name FROM users WHERE email = ? AND  password = ?");
    $stmt->bind_param("ss", $_POST['loginEmail'], $_POST['loginPassword']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $stored_name = $row["first_name"];
        $user_role = $row["role"];
    }
  } else {
    $_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>Oops... Please check your email and password are correct.<?div>";
    $_SESSION['logged_in'] = false;
    header('location: ../guest-login');
    exit;
  }
    $stmt->close();
} else {
    header('location: ../wishlist.php');
    exit;
}
    // Register global variables for user role
    $_SESSION['guestUserName'] = "<p>Welcome " . $stored_name . "!</p>";
    $_SESSION['logged_in'] = true;
    $admin_user_role = 3;

    if ($user_role === $admin_user_role) {
        $_SESSION['logged_in'] = true;

        header('location: ../wishlist.php');
    } else {
        $_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>Sorry " . $stored_name . ", you have not entered the correct details.<?div>";
        $_SESSION['logged_in'] = false;
        unset($_SESSION['guestUserName']);
        header('location: ../guest-login');
        exit;
      }
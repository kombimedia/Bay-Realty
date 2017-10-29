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
    // check if field is populated
    if (empty($_POST['loginPassword'])) {
      $_SESSION["passwordError"] = "<div class='validate-error-message mb-2'>A password is required</div>";
      $validPassword = false;
    }
    // Encrypt password to check against encrypted saved password
    $_POST['loginPassword'] = md5($_POST['loginPassword']);
}

// If all validation passes set valid_login_form variable to true
$valid_Login_form = $validEmail && $validPassword;

// Only connect to database if form passes validation
if ($valid_Login_form) {
    // Create connection
    include '../includes/db-connect.php';
    // get users details from database
    $stmt = $mysqli->prepare("SELECT role, first_name FROM users WHERE email = ? AND  password = ?");
    $stmt->bind_param("ss", $_POST['loginEmail'], $_POST['loginPassword']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        // Save user details to variables
        $stored_name = $row["first_name"];
        $user_role = $row["role"];
    }
  } else {
    // If email or password do not match a db record, throw an error
    $_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>Oops... Please check your email and password are correct.<?div>";
    $_SESSION['logged_in'] = false;
    header('location: ../dashboard-login');
    exit;
  }
    $stmt->close();
} else {
    // If form validation fails redirect back to login page
    header('location: ../dashboard-login');
    exit;
}
    // Register global variables for user role
    $_SESSION['userName'] = "Welcome " . $stored_name . "!";
    $_SESSION['logged_in'] = true;
    $admin_user_role = 4;
    // If user's email and password match a db record and their user role is an admin user, set logged in session to true and redirect to dashboard
    if ($user_role === $admin_user_role) {
        $_SESSION['logged_in'] = true;
        header('location: ../dashboard');
    } else {
        // If user's email and password match a db record but their user role is NOT an admin user, throw an error message, set logged in session to false and redirect back to login page
        $_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>Sorry " . $stored_name . ", you don't have access to the Admin Dashboard.<?div>";
        $_SESSION['logged_in'] = false;
        // Remove 'Welcome user' message
        unset($_SESSION['userName']);
        header('location: ../dashboard-login');
        exit;
      }

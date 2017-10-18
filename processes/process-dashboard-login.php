<?php
session_start();
if (isset($_POST['submit'])) {
    // Get for data and save into variables
    $login_email = ($_POST['loginEmail']);
    $login_password = ($_POST['loginPassword']);
    // Save login email to session to repopulate email field if login fails
    $_SESSION["storeLoginEmail"] = $login_email;
    // Validate input fields
    // validate email
    $valid_Login_email = true;
    // check if field is populated
    if (empty($_POST["loginEmail"])) {
      $valid_Login_email = false;
    } else {
      $valid_Login_email = true;
      }
    // validate password
    $valid_login_password = true;
    // check if field is populated
    if (empty($_POST["loginPassword"])) {
      $valid_login_password = false;
    } else {
      $valid_login_password = true;
      }
    //$login_password = md5($login_password);
}
// If all validation passes set validLoginForm variable to true
$valid_Login_form = $valid_Login_email && $valid_login_password;

// Only connect to database if form passes validation
if ($valid_Login_form) {
    // Create connection
    include '../includes/db-connect.php';
    // get users details from database and save to variables
    $stmt = $mysqli->prepare("SELECT role, first_name FROM users WHERE email = ? AND  password = ?");
    $stmt->bind_param("ss", $login_email, $login_password);
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
    header('location: ../dashboard-login');
    exit;
  }
    $stmt->close();
}
    // Register variables for user role
    $_SESSION['userName'] = "Welcome " . $stored_name . "!";
    $_SESSION['logged_in'] = true;
    $admin_user_role = 4;

    if ($user_role === $admin_user_role) {
        $_SESSION['logged_in'] = true;
        header('location: ../dashboard');
    } else {
        $_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>Oops... You don't have access to the Admin Dashboard.<?div>";
        $_SESSION['logged_in'] = false;
        header('location: ../dashboard-login');
        exit;
      }
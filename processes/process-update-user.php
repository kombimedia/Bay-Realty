<?php
session_start();
if (isset($_POST['submit'])) {

    include '../includes/db-connect.php';

    // Get user ID and save to a variable
    $update_user_id = $_SESSION['update_user_id'];
    $_POST["password"] = md5($_POST["password"]);

    // Update existing listing in database
    $stmt = $mysqli->prepare("UPDATE users SET first_name = ?, surname = ?, email = ?, role = ?, password = ? WHERE user_id = ?");
    $stmt->bind_param("sssisi", $_POST["firstName"], $_POST["surname"], $_POST["email"], $_POST["role"], $_POST["password"], $update_user_id);
    if (!$stmt->execute()) {
          $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
          //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
          $stmt->close();
          header('location: ../dashboard-update-user');
          exit;
    } else {
        // if listing is successful updated go to dashboard 'view users' page and print success message
        $_SESSION["successMessage"] = "<div class='success-message'>User with ID: " . $update_user_id . " was successfully updated.</div>";
        header('location: ../dashboard-view-users');
        }
    $stmt->close();
}

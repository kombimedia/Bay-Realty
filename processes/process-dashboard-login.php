<?php
// session_start();
// if (isset($_POST['submit'])) {
//     // Get for data and save into variables
//     $login_email = ($_POST['loginEmail']);
//     $login_password = ($_POST['loginPassword']);
//     // Save login email to session to repopulate email field if login fails
//     $_SESSION["storeLoginEmail"] = $login_email;
//     // Validate input fields
//     // validate email
//     $valid_Login_email = true;
//     // check if field is populated
//     if (empty($_POST["loginEmail"])) {
//       $valid_Login_email = false;
//     } else {
//       // run function to clean up input strings
//       //$login_email = test_input($_POST["loginEmail"]);
//       $valid_Login_email = true;
//       }
//     // validate password
//     $valid_login_password = true;
//     // check if field is populated
//     if (empty($_POST["loginPassword"])) {
//       $valid_login_password = false;
//     } else {
//       // run function to clean up input strings
//       //$login_password = test_input($_POST["loginPassword"]);
//       $valid_login_password = true;
//       }
//     //$login_password = md5($login_password);

//     // function to clean up input strings before adding to db
//     // function test_input($data) {
//     //   $data = trim($data);
//     //   $data = stripslashes($data);
//     //   $data = htmlspecialchars($data);
//     //   return $data;
//     // }


// }
// // If all validation passes set validLoginForm variable to true
// $valid_Login_form = $valid_Login_email && $valid_login_password;

// // Only connect to database if form passes validation
// if ($valid_Login_form) {
//     // Create connection
//     include '../includes/db-connect.php';
//     // get users details from database and save to variables
//     $stmt = $mysqli->prepare("SELECT first_name, email, role, password FROM users");
//     //$stmt->bind_param("s", $_POST['name']);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     if($result->num_rows > 0) {
//       while($row = $result->fetch_assoc()) {
//         $stored_name = $row["first_name"];
//         $stored_email = $row["email"];
//         $stored_pass = $row["password"];
//         $user_role = $row["role"];

//     $valid_credentials = true;
//     // compare current email and password to database. If match found redirect to welcome page
//     if ($login_email === $stored_email && $login_password === $stored_pass) {
//         $valid_credentials = true;

//       } else {
//         $_SESSION['login_error'] = "<div class='validate-error-message mb-2'>Oops... Your email and password don't match. Please try again.<?div>";
//         //$_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>".$stored_email.", ".$user_role."<?div>";
//         // print_r ("Email Failed: " . $stored_email."<br>");
//         // print_r ("Email Failed: " . $user_role."<br>");
//         $valid_credentials = false;
//         header('location: ../dashboard-login');
//         exit;
//       }

//     if ($valid_credentials) {
//         // Register variables for user role
//         $_SESSION["userName"] = $stored_name;
//         $_SESSION['logged_in'] = true;
//         $admin_user_role = 4;

//         if ($user_role === $admin_user_role) {
//             $_SESSION['logged_in'] = true;
//             //echo "everything passed";
//             header('location: ../dashboard');
//             exit;
//         } else {
//             $_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>Oops... You don't have access to the Admin Dashboard.<?div>";
//             //$_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>".$stored_email.", ".$user_role."<?div>";
//             // print_r ("Role Failed: " . $stored_email."<br>");
//             // print_r ("Role Failed: " . $user_role."<br>");
//             $_SESSION['logged_in'] = false;
//             header('location: ../dashboard-login');
//             exit;
//           }
//     } else {
//       header('location: ../dashboard-login');
//       }
//     }
//     $stmt->close();
//   }
// }
//         // print_r("Name: " . $stored_name."<br>");
//         // print_r("Email: " . $stored_email."<br>");
//         // print_r("password: " . $stored_pass."<br>");
//         // print_r("User: " . $user_role."<br>");




















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
      // run function to clean up input strings
      //$login_email = test_input($_POST["loginEmail"]);
      $valid_Login_email = true;
      }
    // validate password
    $valid_login_password = true;
    // check if field is populated
    if (empty($_POST["loginPassword"])) {
      $valid_login_password = false;
    } else {
      // run function to clean up input strings
      //$login_password = test_input($_POST["loginPassword"]);
      $valid_login_password = true;
      }
    //$login_password = md5($login_password);

    // function to clean up input strings before adding to db
    // function test_input($data) {
    //   $data = trim($data);
    //   $data = stripslashes($data);
    //   $data = htmlspecialchars($data);
    //   return $data;
    // }


}
// If all validation passes set validLoginForm variable to true
$valid_Login_form = $valid_Login_email && $valid_login_password;

// Only connect to database if form passes validation
if ($valid_Login_form) {
    // Create connection
    include '../includes/db-connect.php';
    // get users details from database and save to variables
    $stmt = $mysqli->prepare("SELECT first_name, email, role, password FROM users");
    //$stmt->bind_param("s", $_POST['name']);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $arr[] = $row;
        $stored_name = $row["first_name"];
        $stored_email = $row["email"];
        $stored_pass = $row["password"];
        $user_role = $row["role"];
        // print_r("Name: " . $stored_name."<br>");
        // print_r("Email: " . $stored_email."<br>");
        // print_r("password: " . $stored_pass."<br>");
        // print_r("User: " . $user_role."<br>");

    }
  }
    $stmt->close();
}

$valid_credentials = true;
// compare current email and password to database. If match found redirect to welcome page
if ($login_email != $stored_email || $login_password != $stored_pass) {
    $_SESSION['login_error'] = "<div class='validate-error-message mb-2'>Oops... Your email or password don't seem to match. Please try again.<?div>";
    //$_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>".$stored_email.", ".$user_role."<?div>";
    // print_r ("Email Failed: " . $stored_email."<br>");
    // print_r ("Email Failed: " . $user_role."<br>");
    $valid_credentials = false;
    header('location: ../dashboard-login');
    //exit;
  } else {
    $valid_credentials = true;
  }

if ($valid_credentials) {
    // Register variables for user role
    $_SESSION["userName"] = $stored_name;
    $_SESSION['logged_in'] = true;
    $admin_user_role = 4;

    if ($user_role != $admin_user_role) {
        $_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>Oops... You don't have access to the Admin Dashboard.<?div>";
        //$_SESSION['user_access_error'] = "<div class='validate-error-message mb-2'>".$stored_email.", ".$user_role."<?div>";
        // print_r ("Role Failed: " . $stored_email."<br>");
        // print_r ("Role Failed: " . $user_role."<br>");
        $_SESSION['logged_in'] = false;
        header('location: ../dashboard-login');
        exit;
    } else {
        $_SESSION['logged_in'] = true;
        //echo "everything passed";
        header('location: ../dashboard');
        exit;
      }
} else {
  header('location: ../dashboard-login');
}

<?php
  $title = "Dashboard Login";
  $metaD = "Admin dashboard login page";
  include 'includes/dashboard-header.php';
?>

<div class="container-fluid">
    <div class="login-form-box">
      <form class="form-signin" method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <h2 class="form-signin-heading mb-4">Please log in</h2>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name="loginEmail" class="form-control mb-2" placeholder="Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="loginPassword" class="form-control mb-3" placeholder="Password" required>
          <button class="btn btn-lg btn-block" type="submit">Log in</button>
        </form>
    </div>
</div>

<?php



//Set variables
// $login_email = ($_POST['loginEmail']);
// $login_password = ($_POST['loginPassword']);
// $user_role = "";
// //Global variables
// $_SESSION["storeLoginEmail"] = $login_email;
// // Validate input fields
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   // validate email
//   $valid_Login_email = true;
//   // check if field is populated
//   if (empty($_POST["loginEmail"])) {
//     $valid_Login_email = false;
//   } else {
//     // run function to clean up input strings
//     $login_email = test_input($_POST["loginEmail"]);
//     $valid_Login_email = true;
//     }
//   // validate password
//   $valid_login_password = true;
//   // check if field is populated
//   if (empty($_POST["loginPassword"])) {
//     $valid_login_password = false;
//   } else {
//     // run function to clean up input strings
//     $login_password = test_input($_POST["loginPassword"]);
//     $valid_login_password = true;
//     }
//   //$login_password = md5($login_password);
// }

// // function to clean up input strings before adding to db
// function test_input($data) {
//   $data = trim($data);
//   $data = stripslashes($data);
//   $data = htmlspecialchars($data);
//   return $data;
// }

// // If all validation passes set validLoginForm variable to true
// $valid_Login_form = $valid_Login_email && $valid_login_password;

// // Only connect to database if form passes validation
// if ($valid_Login_form) {
//     // Create connection
//     //include 'includes/db-connect.php';
//     // get users email and password from database and save to variables
//       $stmt = $mysqli->prepare("SELECT first_name, email, role, password FROM users");
//       //$stmt->bind_param("s", $_POST['name']);
//       $stmt->execute();
//       $result = $stmt->get_result();
//       if($result->num_rows > 0) {
//         while($row = $result->fetch_assoc()) {
//           $arr[] = $row;
//           $stored_name = row["first_name"];
//           $stored_email = $row["email"];
//           $stored_pass = $row["password"];
//           $user_role = $row["role"];
//         }
//       }
//       $stmt->close();
// }
// // compare current email and password to database. If match found redirect to welcome page
// if ($login_email != $stored_email && $login_password != $stored_pass) {
//   echo "Your email or password are invalid";
// }
?>

<?php
  include 'includes/dashboard-footer.php';
?>

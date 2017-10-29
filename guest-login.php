<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
$title = "Bay Realty - Login Page";
$metaD = "Secure login page";
include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="login-form-box">
       <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
       <form class="form-signin" method="post" name="submit" role="form" action="processes/process-guest-login.php">
          <h2 class="form-signin-heading mb-4">Wish List log in</h2>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name="loginEmail" class="form-control mb-2" placeholder="Email address" required autofocus value="<?php if (isset($_SESSION['storeLoginEmail'])) { echo $_SESSION['storeLoginEmail']; unset($_SESSION['storeLoginEmail']); }; ?>">
          <div><?php if (isset($_SESSION['emailError'])) { echo $_SESSION['emailError']; unset($_SESSION['emailError']); }; ?></div>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="loginPassword" class="form-control mb-3" placeholder="Password" required>
          <div class="mb-2"><?php if (isset($_SESSION['passwordError'])) { echo $_SESSION['passwordError']; unset($_SESSION['passwordError']); }; ?></div>
          <div><?php if (isset($_SESSION['login_error'])) { echo $_SESSION['login_error']; unset($_SESSION['login_error']); }; ?></div>
          <div><?php if (isset($_SESSION['user_access_error'])) { echo $_SESSION['user_access_error']; unset($_SESSION['user_access_error']); }; ?></div>
          <button class="btn btn-md btn-block" name="submit" type="submit">Log in</button>
        </form>
        <p>Not registered for Wish List? <a class="form-link" href="guest-register">Sign Up!</a></p>
    </div>
</div>

<?php
  include 'includes/footer.php';
?>

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
        <div><?php if (isset($_SESSION['guestRegisterSuccessMessage'])) { echo $_SESSION['guestRegisterSuccessMessage']; unset($_SESSION['guestRegisterSuccessMessage']); }; ?></div>
       <form class="form-signin" method="post" name="submit" role="form" action="processes/process-guest-login.php">
          <h2 class="form-signin-heading mb-4">Wish List log in</h2>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name="loginEmail" class="form-control mb-2" placeholder="Email address" required autofocus value="<?php if (isset($_SESSION['storeLoginEmail'])) { echo $_SESSION['storeLoginEmail']; unset($_SESSION['storeLoginEmail']); }; ?>">
          <div><?php if (isset($_SESSION['guestEmailError'])) { echo $_SESSION['guestEmailError']; unset($_SESSION['guestEmailError']); }; ?></div>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="loginPassword" class="form-control mb-3" placeholder="Password" required>
          <div class="mb-2"><?php if (isset($_SESSION['guestPasswordError'])) { echo $_SESSION['guestPasswordError']; unset($_SESSION['guestPasswordError']); }; ?></div>
          <div><?php if (isset($_SESSION['guestLoginError'])) { echo $_SESSION['guestLoginError']; unset($_SESSION['guestLoginError']); }; ?></div>
          <div><?php if (isset($_SESSION['guestAccessError'])) { echo $_SESSION['guestAccessError']; unset($_SESSION['guestAccessError']); }; ?></div>
          <button class="btn btn-md btn-block" name="submit" type="submit">Log in</button>
        </form>
        <p>Not registered for Wish List? <a class="form-link" href="guest-register">Sign Up!</a></p>
    </div>
</div>
<?php
  include 'includes/footer.php';
?>

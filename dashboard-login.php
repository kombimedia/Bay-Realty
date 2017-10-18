<?php
session_start();
$title = "Dashboard Login";
$metaD = "Admin dashboard login page";
include 'includes/dashboard-header.php';
?>

<div class="container-fluid">
    <div class="login-form-box">
      <form class="form-signin" method="post" role="form" action="processes/process-dashboard-login.php">
          <h3 class="form-signin-heading mb-4">Please log in</h3>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name="loginEmail" class="form-control mb-2" placeholder="Email address" required autofocus value="<?php if (isset($_SESSION['storeLoginEmail'])) { echo $_SESSION['storeLoginEmail']; unset($_SESSION['storeLoginEmail']); }; ?>">
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="loginPassword" class="form-control mb-3" placeholder="Password" required>
          <div><?php if (isset($_SESSION['login_error'])) { echo $_SESSION['login_error']; unset($_SESSION['login_error']); }; ?></div>
          <div><?php if (isset($_SESSION['user_access_error'])) { echo $_SESSION['user_access_error']; unset($_SESSION['user_access_error']); }; ?></div>
          <button class="btn btn-lg btn-block" type="submit" name="submit">Log in</button>
        </form>
    </div>
</div>

<?php
  include 'includes/dashboard-footer.php';
?>

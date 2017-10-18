<?php
$title = "Bay Realty - Login Page";
$metaD = "Secure login page";
include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="login-form-box">
      <form class="form-signin" method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <h2 class="form-signin-heading mb-4">Please log in</h2>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required>
          <button class="btn btn-lg btn-block" type="submit">Log in</button>
        </form>
    </div>
</div>

<?php
  include 'includes/footer.php';
?>

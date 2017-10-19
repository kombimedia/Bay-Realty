<?php
$title = "Bay Realty - Wish List Register Page";
$metaD = "Wish List login page";
include 'includes/header.php';
?>

<div class="container-fluid">
    <div class="login-form-box">
      <form class="form-signin" method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <h2 class="form-signin-heading mb-4">Wish List Sign Up</h2>
          <label for="guest-first-name" class="sr-only">First Name</label>
          <input type="text" id="guest-first-name" class="form-control mb-2" placeholder="First Name" required autofocus>
          <label for="guest-surname" class="sr-only">Surname</label>
          <input type="text" id="guest-surname" class="form-control mb-2" placeholder="Surname" required autofocus>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" class="form-control mb-2" placeholder="Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required>
          <button class="btn btn-md btn-block" type="submit">Sign up</button>
        </form>
        <p>Already registered for Wish List? <a class="form-link" href="guest-login">Log in!</a></p>
    </div>
</div>

<?php
  include 'includes/footer.php';
?>

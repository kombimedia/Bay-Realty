<?php
session_start();
$title = "Bay Realty - Wish List Register Page";
$metaD = "Wish List login page";
include 'includes/header.php';
?>
 
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>

<div class="container-fluid">
    <div class="login-form-box">
      <form class="form-signin" method="post" role="form" action="processes/process-populate-guest-register.php">
          <h2 class="form-signin-heading mb-4">Wish List Sign Up</h2>
          <label for="guest-first-name" class="sr-only">First Name</label>
          <input type="text" id="guest-first-name" name="guestFirstName" class="form-control mb-2" placeholder="First Name" required value="<?php if (isset($_SESSION['storeguestFirstName'])) { echo $_SESSION['storeguestFirstName']; unset($_SESSION['storeguestFirstName']); }; ?>" autofocus>
           <div><?php if (isset($_SESSION['firstNameError'])) { echo $_SESSION['firstNameError']; unset($_SESSION['firstNameError']); }; ?></div>
          <label for="guest-surname" class="sr-only">Surname</label>
          <input type="text" id="guest-surname" name="guestSurname" class="form-control mb-2" placeholder="Surname" required value="<?php if (isset($_SESSION['storeguestSurname'])) { echo $_SESSION['storeguestSurname']; unset($_SESSION['storeguestSurname']); }; ?>" autofocus>
          <div><?php if (isset($_SESSION['surnameError'])) { echo $_SESSION['surnameError']; unset($_SESSION['surnameError']); }; ?></div>
          <label for="inputEmail" class="sr-only">Email address</label>
          <input type="email" id="inputEmail" name="guestEmail" class="form-control mb-2" placeholder="Email address" required value="<?php if (isset($_SESSION['storeguestEmail'])) { echo $_SESSION['storeguestEmail']; unset($_SESSION['storeguestEmail']); }; ?>" autofocus>
          <div><?php if (isset($_SESSION['emailError'])) { echo $_SESSION['emailError']; unset($_SESSION['emailError']); }; ?></div>
          <label for="inputPassword" class="sr-only">Password</label>
          <input type="password" id="inputPassword" name="guestPassword" class="form-control mb-3" placeholder="Password" value="<?php if (isset($_SESSION['storeguestPassword'])) { echo $_SESSION['storeguestPassword']; unset($_SESSION['storeguestPassword']); }; ?>" required>
          <div><?php if (isset($_SESSION['passwordError'])) { echo $_SESSION['passwordError']; unset($_SESSION['passwordError']); }; ?></div>
          <button class="btn btn-md btn-block" type="submit" name="submit" value="Create User">Sign up</button>
        </form>
        <p>Already registered for Wish List? <a class="form-link" href="guest-login">Log in!</a></p>
    </div>
</div>

<?php
  include 'includes/footer.php';
?>

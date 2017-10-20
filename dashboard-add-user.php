<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

  $title = "Add Users";
  $metaD = "Admin dashboard page, add users";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
  include 'processes/process-populate-add-user.php'
?>

  <h1>Add New User</h1>
<!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>

    <form class="add-listing-form" method="post" role="form" action="processes/process-add-user.php">
      <div class="listing-form">
        <h3>User Details</h3>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-3 mb-3">
            <label for="first-name">First Name</label>
            <input class="form-control wide" name="firstName" id="first-name" placeholder="User's first name" required value="<?php if (isset($_SESSION['storeFirstName'])) { echo $_SESSION['storeFirstName']; unset($_SESSION['storeFirstName']); }; ?>">
            <div><?php if (isset($_SESSION['firstNameError'])) { echo $_SESSION['firstNameError']; unset($_SESSION['firstNameError']); }; ?></div>
          </div>
          <div class="col-12 col-xl-3 mb-3">
            <label for="surname">Surname</label>
            <input class="form-control wide" name="surname" id="surname" placeholder="User's surname" required value="<?php if (isset($_SESSION['storeSurname'])) { echo $_SESSION['storeSurname']; unset($_SESSION['storeSurname']); }; ?>">
            <div><?php if (isset($_SESSION['surnameError'])) { echo $_SESSION['surnameError']; unset($_SESSION['surnameError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-3 mb-3">
            <label for="email">Email Address</label>
            <input type="email" class="form-control wide" name="email" id="email" placeholder="User's email address" required value="<?php if (isset($_SESSION['storeEmail'])) { echo $_SESSION['storeEmail']; unset($_SESSION['storeEmail']); }; ?>">
            <div><?php if (isset($_SESSION['emailError'])) { echo $_SESSION['emailError']; unset($_SESSION['emailError']); }; ?></div>
          </div>

          <div class="col-12 col-xl-3 mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control wide" name="password" id="password" placeholder="User's password" required value="<?php if (isset($_SESSION['storePassword'])) { echo $_SESSION['storePassword']; unset($_SESSION['storePassword']); }; ?>">
            <div><?php if (isset($_SESSION['passwordError'])) { echo $_SESSION['passwordError']; unset($_SESSION['passwordError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-3 mb-3">
            <label for="role">User Role</label>
            <select class="form-control wide" name="role" id="role" value="">
              <option value="" disabled selected>Select role</option>
              <?php echo $option_role ?>
            </select>
            <div><?php if (isset($_SESSION['userRoleError'])) { echo $_SESSION['userRoleError']; unset($_SESSION['userRoleError']); }; ?></div>
          </div>
        </div>
        <input type="submit" value="Create User" name="submit" class="btn"/>
    </div>
  </form>

<?php
include 'includes/dashboard-footer.php';
?>

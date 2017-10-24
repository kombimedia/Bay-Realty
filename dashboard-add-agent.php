<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "Add Agent";
$metaD = "Admin dashboard page, add Agent";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
include 'processes/process-populate-add-agent.php';
?>

  <h1>Add New Agent</h1>
<!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>

    <form class="add-listing-form" method="post" role="form" action="processes/process-add-agent.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Agent Details</h3>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-3 mb-3">
            <label for="first-name">First Name</label>
            <input class="form-control wide" name="firstName" id="first-name" placeholder="Agent's first name" required value="<?php if (isset($_SESSION['storeFirstName'])) { echo $_SESSION['storeFirstName']; unset($_SESSION['storeFirstName']); }; ?>">
            <div><?php if (isset($_SESSION['firstNameError'])) { echo $_SESSION['firstNameError']; unset($_SESSION['firstNameError']); }; ?></div>
          </div>
          <div class="col-12 col-xl-3 mb-3">
            <label for="surname">Surname</label>
            <input class="form-control wide" name="surname" id="surname" placeholder="Agent's surname" required value="<?php if (isset($_SESSION['storeSurname'])) { echo $_SESSION['storeSurname']; unset($_SESSION['storeSurname']); }; ?>">
            <div><?php if (isset($_SESSION['surnameError'])) { echo $_SESSION['surnameError']; unset($_SESSION['surnameError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-3 mb-3">
            <label for="email">Email Address</label>
            <input type="email" class="form-control wide" name="email" id="email" placeholder="Agent's email address" required value="<?php if (isset($_SESSION['storeEmail'])) { echo $_SESSION['storeEmail']; unset($_SESSION['storeEmail']); }; ?>">
            <div><?php if (isset($_SESSION['emailError'])) { echo $_SESSION['emailError']; unset($_SESSION['emailError']); }; ?></div>
          </div>

          <div class="col-12 col-xl-3 mb-3">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control wide" name="phone" id="phone" placeholder="(021)1234567" required value="<?php if (isset($_SESSION['storePhone'])) { echo $_SESSION['storePhone']; unset($_SESSION['storePhone']); }; ?>">
            <div><?php if (isset($_SESSION['phoneError'])) { echo $_SESSION['phoneError']; unset($_SESSION['phoneError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-6 mb-3">
              <label for="agent-des">Description</label>
              <textarea rows="3" class="form-control" name="agentDes" id="agent-des" required  placeholder="Something about the agent"><?php if (isset($_SESSION['storeAgentDes'])) { echo $_SESSION['storeAgentDes']; unset($_SESSION['storeAgentDes']); }; ?></textarea>
              <div><?php if (isset($_SESSION['agentDesError'])) { echo $_SESSION['agentDesError']; unset($_SESSION['agentDesError']); }; ?></div>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-3 mb-3">
            <label for="role">Area</label>
            <select class="form-control wide" name="area" id="area" required value="">
              <option value="" disabled selected>Select area</option>
              <?php echo $option_area ?>
            </select>
            <div><?php if (isset($_SESSION['areaError'])) { echo $_SESSION['areaError']; unset($_SESSION['areaError']); }; ?></div>
          </div>
        </div>

    </div> <!-- listing form div -->

    <!-- Image upload tool -->
    <div class="form-row form-inline">
      <div class="col col-lg-6">
        <div class="image-form">
          <h3 class="mb-4">Profile Image</h3>
          <label for="file">Upload Profile Image</label>
          <small id="pro-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted, max size 500KB</small><br>
          <div id="filediv">
            <input class="form-control" name="file[]" type="file" id="file" required  aria-describedby="pro-image-help"/>
          </div>
          <div><?php if (isset($_SESSION['imgUploadError'])) { echo $_SESSION['imgUploadError']; unset($_SESSION['imgUploadError']); }; ?></div>
          <div><?php if (isset($_SESSION['imgFileError'])) { echo $_SESSION['imgFileError']; unset($_SESSION['imgFileError']); }; ?></div>
          <div><?php if (isset($_SESSION['imgError'])) { echo $_SESSION['imgError']; unset($_SESSION['imgError']); }; ?></div>
        </div>
      </div>
    </div>

    <input type="submit" value="Create Agent" name="submit" class="btn"/>

  </form>

<?php
include 'includes/dashboard-footer.php';
?>

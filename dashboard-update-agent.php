<?php
session_start();
if (!$_SESSION['logged_in']) {
    header('location: dashboard-login');
}

$title = "Update Agent";
$metaD = "Admin dashboard page, update agent";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
include 'processes/process-populate-update-agent.php';
?>
  <h1>Update Agent</h1>
<!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['errorMessage'])) { echo $_SESSION['errorMessage']; unset($_SESSION['errorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['proPicErrorMessage'])) { echo $_SESSION['proPicErrorMessage']; unset($_SESSION['proPicErrorMessage']); }; ?></div>
  <div><?php if (isset($_SESSION['imageDelFileError'])) { echo $_SESSION['imageDelFileError']; unset($_SESSION['imageDelFileError']); }; ?></div>

<form class="add-listing-form" method="post" role="form" action="processes/process-update-agent.php" enctype="multipart/form-data">
      <div class="listing-form">
        <h3>Current Agent Details</h3>
        <h5>Agent #<?php echo $agent_id ?></h5>
        <div class="form-row form-inline mt-4">
          <div class="col-12 col-xl-3 mb-3">
            <label for="first-name">First Name</label>
            <input class="form-control wide" name="firstName" id="first-name" placeholder="Agent's first name" required value="<?php echo $first_name ?>">
          </div>
          <div class="col-12 col-xl-3 mb-3">
            <label for="surname">Surname</label>
            <input class="form-control wide" name="surname" id="surname" placeholder="Agent's surname" required value="<?php echo $surname ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-3 mb-3">
            <label for="email">Email Address</label>
            <input type="email" class="form-control wide" name="email" id="email" placeholder="Agent's email address" required value="<?php echo $email ?>">
          </div>

          <div class="col-12 col-xl-3 mb-3">
            <label for="phone">Phone Number</label>
            <input type="text" class="form-control wide" name="phone" id="phone" placeholder="(+64) 21 2880078" required value="<?php echo $phone ?>">
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-6 mb-3">
              <label for="agent-des">Description</label>
              <textarea rows="3" class="form-control" name="agentDes" id="agent-des" required  placeholder="Something about the agent"><?php echo $profile ?></textarea>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-3 mb-3">
            <label for="role">Area</label>
            <select class="form-control wide" name="area" id="area" required value="">
              <option value="" disabled>Select area</option>
              <?php echo $option_area ?>
            </select>
          </div>
        </div>

        <div class="form-row form-inline">
          <div class="col-12 col-xl-3 mb-3">
            <label class="mb-1" for="profile-pic">Current Profile Pic</label>
            <img id="profile-pic" src="images/uploads/<?php echo $profile_pic ?>" width="100" height="100">
          </div>
        </div>

    </div> <!-- listing form div -->

    <!-- Image upload tool -->
    <div class="form-row form-inline">
      <div class="col col-lg-6">
        <div class="image-form">
          <h3 class="mb-4">Update Profile Image</h3>
          <label for="file">Choose a Different Profile Image</label>
          <small id="pro-image-help" class="form-text text-muted">png, jpg or jpeg file types accepted, max size 500KB</small><br>
          <div id="filediv">
            <!-- <input class="form-control" name="file[]" type="file" id="file" aria-describedby="pro-image-help"/> -->
          </div>
          <input type="button" id="add_more" class="btn" value="Change Profile Pic"/>
          <div><?php if (isset($_SESSION['imgUploadError'])) { echo $_SESSION['imgUploadError']; unset($_SESSION['imgUploadError']); }; ?></div>
          <div><?php if (isset($_SESSION['imgFileError'])) { echo $_SESSION['imgFileError']; unset($_SESSION['imgFileError']); }; ?></div>
          <div><?php if (isset($_SESSION['imgError'])) { echo $_SESSION['imgError']; unset($_SESSION['imgError']); }; ?></div>
        </div>
      </div>
    </div>

    <input type="submit" value="Update Agent" name="submit" class="btn"/>

  </form>

<?php
include 'includes/dashboard-footer.php';
?>

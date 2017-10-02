<?php
  $title = "View Listings";
  $metaD = "Admin dashboard page, view listings";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>View Listing</h1>

  <div id="formdiv">
      <h2>Multiple Image Upload Form</h2>

      <div><?php if (isset($_SESSION['imageSuccess'])) { echo $_SESSION['imageSuccess']; unset($_SESSION['imageSuccess']); }; ?></div>
      <div><?php if (isset($_SESSION['imageError'])) { echo $_SESSION['imageError']; unset($_SESSION['imageError']); }; ?></div>

      <form enctype="multipart/form-data" action="processes/process-image-upload.php" method="post">
          First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 500KB.
          <hr/>
          <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

          <input type="button" id="add_more" class="upload" value="Add More Files"/>
          <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
      </form>
      <!--Including PHP Script here-->
  </div>

<?php
  //include 'processes/process-image-upload.php';
  include 'includes/dashboard-footer.php';
?>



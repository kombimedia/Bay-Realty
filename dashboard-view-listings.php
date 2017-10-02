<?php
  $title = "View Listings";
  $metaD = "Admin dashboard page, view listings";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>View Listing</h1>

  <div id="formdiv">
      <h2>Multiple Image Upload Form</h2>
      <form enctype="multipart/form-data" action="" method="post">
          First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 500KB.
          <hr/>
          <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

          <input type="button" id="add_more" class="upload" value="Add More Files"/>
          <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
      </form>
      <br/>
      <br/>
      <!--Including PHP Script here-->
      <?php include "includes/image-upload.php"; ?>
  </div>

<?php
  include 'includes/dashboard-footer.php';
?>



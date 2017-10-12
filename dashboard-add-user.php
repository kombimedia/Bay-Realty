<?php
  $title = "Add Users";
  $metaD = "Admin dashboard page, add users";
  include 'includes/dashboard-header.php';
  include 'includes/dashboard-sidebar.php';
?>

  <h1>Add New User</h1>


<!-- DB error/success messages -->
  <div><?php if (isset($_SESSION['dbSuccess'])) { echo $_SESSION['dbSuccess']; unset($_SESSION['dbSuccess']); }; ?></div>
  <div><?php if (isset($_SESSION['dbError'])) { echo $_SESSION['dbError']; unset($_SESSION['dbError']); }; ?></div>




<!-- Update Featured Image -->
<div id="featured-image-form">
    <div class="col pl-0 pr-0">
      <div class="featured-image-form">
          <h3 class="mb-4">Change Featured Image</h3>

<?php
$listing_id = $_SESSION["update_listing_id"];
$getData4 = "SELECT img_name
            FROM images
            WHERE listing_id = $listing_id";
    $result4 = $mysqli->query($getData4);
    // Check if there are any records to show
    if ($result4->num_rows > 0) {
        // Loop through data and output each row
        while($row4 = $result4->fetch_assoc()) {
?>

          <label class="custom-control custom-radio">
            <input id="" name="radio" type="radio" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description"><img class="img-fluid" src="images/uploads/<?php echo $row4['img_name']?>" width="300"></span>
          </label>

<?php
        }
      } else {
          echo "No images listings to show";
      }
?>

          <small id="" class="form-text text-muted">Select an image to replace the existing featured image</small>
      </div>
    </div>
</div>





<?php
echo $row4['img_name'] . " " . $listing_id;
include 'includes/dashboard-footer.php';
?>

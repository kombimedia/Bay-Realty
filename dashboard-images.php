<?php
session_start();
$title = "Images";
$metaD = "Admin dashboard page, site images";
include 'includes/dashboard-header.php';
include 'includes/dashboard-sidebar.php';
?>
<h1>Images</h1>

<div><?php if (isset($_SESSION['imageDelSuccess'])) { echo $_SESSION['imageDelSuccess']; unset($_SESSION['imageDelSuccess']); }; ?></div>
<div><?php if (isset($_SESSION['imageDelError'])) { echo $_SESSION['imageDelError']; unset($_SESSION['imageDelError']); }; ?></div>

<table class="table table-responsive table-striped table-images">
  <thead class="images-head">
    <tr>
      <th>Featured Image</th>
      <th>Image ID</th>
      <th>Listing ID</th>
      <th>Name</th>
      <th>Size</th>
      <th>Type</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>

<?php

$getData = "SELECT image_id, listing_id, img_name, img_size, img_type
            FROM images
            ORDER BY img_name ASC";
    $result = $mysqli->query($getData);
    // Check if there are any records to show
    if ($result->num_rows > 0) {
        // Loop through data and output each row
        while($row = $result->fetch_assoc()) {
?>
          <tr>
              <td><img width="250" src="images/uploads/<?php echo $row['img_name'] ?>"></td>
              <td> <?php echo $row['image_id'] ?> </td>
              <td> <?php echo $row['listing_id'] ?> </td>
              <td> <?php echo $row['img_name'] ?> </td>
              <td> <?php echo $row['img_size']; ?> </td>
              <td> <?php echo $row['img_type']; ?> </td>
              <td><a class="delete-image" href="#" onClick="deleteimage('<?php echo $row['image_id']; ?>')"><img src="images/x.png"></a></td>
          </tr>
<?php
        }
      } else {
          echo "No property listings to show";
      }
?>
    </tbody>
  </table>

<script language="javascript">
 function deleteimage(dellimage) {
     if (confirm("Are you sure you want to delete this image?")) {
     window.location.href='processes/process-delete-image.php?del_image=' +dellimage+'';
     return true;
    }
 }
</script>

<?php
include 'includes/dashboard-footer.php';
?>

<?php
$populate_images = "";
$stmt = $mysqli->prepare("SELECT image_id, listing_id, img_name, img_size, img_type FROM images ORDER BY img_name ASC");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  // Loop through data and output data array
  while($row = $result->fetch_assoc()) {
      // Convert file size to KB and round to whole number
      $row['img_size'] = ($row['img_size']) / 1000;
      $row['img_size'] = ceil($row['img_size']);
      // Build table row for each image to display on page
      $populate_images = $populate_images . "
      <tr>
          <td><img width='250' src='images/uploads/$row[img_name]'></td>
          <td>$row[image_id]</td>
          <td>$row[listing_id]</td>
          <td>$row[img_name]</td>
          <td>$row[img_size]KB</td>
          <td>$row[img_type]</td>
          <td><a class='delete-image' href='#' onClick='deleteimage($row[image_id])'><img src='images/x.png'></a></td>
      </tr>";
      }
  } else {
      $_SESSION["imageError"] = "<div class='error-message'>No listing images to show</div>";
  }
$stmt->close();

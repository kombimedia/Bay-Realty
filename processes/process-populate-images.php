<?php
$populate_images = "";
$stmt = $mysqli->prepare("SELECT image_id, listing_id, img_name, img_size, img_type FROM images ORDER BY img_name ASC");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $arr[] = $row;
      $populate_images = $populate_images . "
          <tr>
              <td><img width='250' src='images/uploads/$row[img_name]'></td>
              <td>$row[image_id]</td>
              <td>$row[listing_id]</td>
              <td>$row[img_name]</td>
              <td>$row[img_size]</td>
              <td>$row[img_type]</td>
              <td><a class='delete-image' href='#' onClick='deleteimage($row[image_id])'><img src='images/x.png'></a></td>
          </tr>";
        }
      } else {
          $_SESSION["imageError"] = "<div class='error-message'>No listing images to show</div>";
      }
$stmt->close();
?>

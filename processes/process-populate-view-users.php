<?php
$populate_users = "";
$stmt = $mysqli->prepare("SELECT user_id, first_name, surname, email, role FROM users UNION SELECT role_id, user_role FROM user_roles");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      if ($row['role'] === $row['role_id']) {
          $row['role'] = $row['user_role']
      }
      $populate_users = $populate_users . "
          <tr>
              <td>$row[user_id]</td>
              <td>$row[name]</td>
              <td>$row[email]</td>
              <td>$row[role]</td>
              <td><a class='delete-image' href='#' onClick='deleteimage($row[image_id])'><img src='images/x.png'></a></td>
          </tr>";
        }
      } else {
          $_SESSION["imageError"] = "<div class='error-message'>No listing images to show</div>";
      }
$stmt->close();

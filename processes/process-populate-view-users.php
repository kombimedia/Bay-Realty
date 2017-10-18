<?php
$populate_users = "";
$stmt = $mysqli->prepare("SELECT users.user_id, users.first_name, users.surname, users.email, users.role, user_roles.role_id, user_roles.user_role FROM users INNER JOIN user_roles WHERE users.role = user_roles.role_id");
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['role'] === $row['role_id']) {
            $row['role'] = $row['user_role'];
        }
        $name = $row['first_name'] . " " . $row['surname'];
        $populate_users = $populate_users . "
            <tr>
                <td>$row[user_id]<br> <a class='view-user-edit' href='dashboard-update-user.php?user_id=$row[user_id]'>Edit</a> <a class='view-user-delete' href='#' onClick='deleteUser($row[user_id])'>Delete</a> </td>
                <td>$name</td>
                <td>$row[email]</td>
                <td>$row[role]</td>
            </tr>";
          }
        } else {
            $_SESSION["imageError"] = "<div class='error-message'>No User accounts to show</div>";
        }
$stmt->close();

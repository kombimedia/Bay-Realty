<?php
$user_id = $_GET['user_id'];
$_SESSION['update_user_id'] = $user_id;
$option_user_role = "";

$stmt = $mysqli->prepare("SELECT users.user_id, users.first_name, users.surname, users.email, users.role, user_roles.role_id, user_roles.user_role FROM users INNER JOIN user_roles WHERE ? = users.user_id");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Set variables to populate form
        $first_name = $row['first_name'];
        $surname = $row['surname'];
        $email = $row['email'];
        $role = $row['role'];
        // Create dynamic User Role select option
        if ($role == $row['role_id']) {
            $option_user_role = $option_user_role . "<option selected value='$row[role_id]'>$row[user_role]</option>";
            // if the stored value does not match the value in the User Roles table create an option with no 'selected' tag
            } else {
              $option_user_role = $option_user_role . "<option value='$row[role_id]'>$row[user_role]</option>";
              }
        }
} else {
    $_SESSION["imageError"] = "<div class='error-message'>Uh oh... This form shouldn't be empty. Please contact your website administrator.</div>";
    }
$stmt->close();

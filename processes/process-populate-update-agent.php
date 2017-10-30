<?php
// Get Agent ID
$agent_id = $_GET['agent_id'];
$_SESSION['update_agent_id'] = $agent_id;
// Define variable to save 'Select option'
$option_area = "";

$stmt = $mysqli->prepare("SELECT agents.agent_id, agents.first_name, agents.surname, agents.email, agents.phone, agents.description, agents.area_id, agents.profile_pic, categories.cat_id, categories.city FROM agents INNER JOIN categories WHERE ? = agents.agent_id");
$stmt->bind_param("i", $agent_id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Set variables to populate form
        $first_name = $row['first_name'];
        $surname = $row['surname'];
        $email = $row['email'];
        $phone = $row['phone'];
        $profile = $row['description'];
        $area = $row['area_id'];
        $profile_pic = $row['profile_pic'];
        // Create dynamic Area select option
        if ($area == $row['cat_id']) {
            $option_area = $option_area . "<option selected value='$row[cat_id]'>$row[city]</option>";
            // if the stored value does not match the value in the User Roles table create an option with no 'selected' tag
            } else {
              $option_area = $option_area . "<option value='$row[cat_id]'>$row[city]</option>";
              }
        }
} else {
    $_SESSION["imageError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
    }
$stmt->close();

<?php
session_start();
if (isset($_POST['submit'])) {

    include '../includes/db-connect.php';

    // Get Agent ID and save to a variable
    $update_agent_id = $_SESSION['update_agent_id'];

    // Validate profile image and upload
    $validateProfileImage = true;
    if (isset($_FILES['file'])) {
       for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
              // Accepted extensions
              $validextensions = array('jpeg', 'jpg', 'png');
              // Separate file name from dot(.)
              $ext = explode('.', basename($_FILES['file']['name'][$i]));
              // Store extensions to a variable
              $image_type = end($ext);
              // Temporary file storage location path
              $image_tmp = $_FILES['file']['tmp_name'][$i];
              // Set image name
              $image_name = $_FILES['file']['name'][$i];
              // Get image size
              $image_size = $_FILES['file']['size'][$i];
              // Declare path for uploaded images
              $file_path = "../images/uploads/".$image_name;
              // Validate image before storing to folder and DB
              // Limit file size to less than 500kb
              if (($image_size < 500001) && in_array($image_type, $validextensions)) {
                  // Save image files to images/uploads folder
                  if (!move_uploaded_file($image_tmp, $file_path)) {
                      // if file was not moved throw error message
                      $_SESSION["imgUploadError"] = "<div class='validate-error-message'>Uh oh... Image(s) were not saved to the uploads folder.</div>";
                      $validateProfileImage = false;
                  }
                  // if file size or file type were incorrect throw error message
              } else {
                  //$_SESSION["imgFileError"] = "<div class='validate-error-message'>Oops... Please upload an image, max 500kb and a jpg, jpeg or png.</div>";
                  $validateProfileImage = false;
                }
          }
      } else {
        $validateProfileImage = false;
      }

      if ($validateProfileImage) {
          // Delete current profile pic from uploads folder
          $stmt = $mysqli->prepare ("SELECT profile_pic FROM agents WHERE agent_id = ?");
          $stmt->bind_param ("i", $update_agent_id);
          $stmt->execute ();
          $result = $stmt->get_result ();
          if ($result->num_rows === 1) {
            $row = $result->fetch_assoc ();
            // Define path to image file
            $path = "../images/uploads/" . $row['profile_pic'];
            } else {
                // If no matching images are found there is an issue so throw error
                $_SESSION["imageDelFileError"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error. ".<br>Please see your website administrator and quote this error message.</div>";
              }
            // Delete image file from folder
            unlink($path);
            $stmt->close();

          $stmt = $mysqli->prepare("UPDATE agents SET profile_pic = ? WHERE agent_id = ?");
          $stmt->bind_param("si", $image_name, $update_agent_id);
          if (!$stmt->execute()) {
                $_SESSION["proPicErrorMessage"] = "<div class='error-message'>Oops! Your profile pic wasn't updated... Please check you have entered all fields correctly</div>";
                //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
                $stmt->close();
                header('location: ../dashboard-update-agent');
          }
          $stmt->close();
      } else {
            $_SESSION["errorMessage"] = "<div class='error-message'>Oops... Image wasn't uploaded to agent ID: " . $update_agent_id . ". Should be max 500kb and a jpg, jpeg or png. Please try again with a smaller image.</div>";
            header('location: ../dashboard-view-agents');
      }

      // Update existing Agent details in database
      $stmt = $mysqli->prepare("UPDATE agents SET first_name = ?, surname = ?, email = ?, phone = ?, description = ?, area_id = ? WHERE agent_id = ?");
      $stmt->bind_param("sssssii", $_POST["firstName"], $_POST["surname"], $_POST["email"], $_POST["phone"], $_POST["agentDes"], $_POST["area"], $update_agent_id);
      if (!$stmt->execute()) {
            $_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... Please check you have entered all fields correctly</div>";
            //$_SESSION["errorMessage"] = "<div class='error-message'>Oops! Something went wrong... (" . $stmt->errno . ") " . $stmt->error . "</div>";
            $stmt->close();
            header('location: ../dashboard-update-agent');
            exit;
      } else {
          // if listing is successful updated go to dashboard 'all agents' page and print success message
          $_SESSION["successMessage"] = "<div class='success-message'>Agent with ID: " . $update_agent_id . " was successfully updated.</div>";
          header('location: ../dashboard-view-agents');
          }
      $stmt->close();
}

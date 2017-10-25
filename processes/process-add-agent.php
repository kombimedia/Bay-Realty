<?php
session_start();
include 'process-functions-validation.php';

// Save form data to global variables to repopulate form if submit fails
$_SESSION['storeFirstName'] = $_POST['firstName'];
$_SESSION['storeSurname'] = $_POST['surname'];
$_SESSION['storeEmail'] = $_POST['email'];
$_SESSION['storePhone'] = $_POST['phone'];
$_SESSION['storeAgentDes'] = $_POST['agentDes'];

// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validate first name
    $validName = true;
    if (!validate_first_name ($_POST["firstName"])) {
        $validName = false;
    }

    // Validate surname
    $validSName = true;
    if (!validate_surname ($_POST["surname"])) {
        $validSName = false;
    }

    // Validate email address
    $validEmail = true;
    if (!validate_email ($_POST["email"])) {
        $validEmail = false;
    }

    // // Validate phone
    $validPhone = true;
    if (!validate_phone ($_POST["phone"])) {
        $validPhone = false;
    }

    // Valid entry Agent Description
    $validAgentDes = true;
    if (!validate_agent_description($_POST["agentDes"])) {
        $_SESSION["agentDesError"] = "<div class='validate-error-message'>An Agent description is required</div>";
        $validAgentDes = false;
    }

    // Validate user role
    $validArea = true;
    if (empty($_POST["area"])) {
        $_SESSION["areaError"] = "<div class='validate-error-message'>An area is required</div>";
        $validArea = false;
    }

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
              $image_size = $_FILES['file']['size'][$i] . 'Bytes';
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
                  $_SESSION["imgFileError"] = "<div class='validate-error-message'>Oops... Please upload an image, max 500kb and a jpg, jpeg or png.</div>";
                  $validateProfileImage = false;
                }
          }
      }
  }

// If all validation passes set validForm variable to true
$validForm = $validName && $validSName && $validEmail && $validPhone && $validAgentDes && $validArea && $validateProfileImage;

if ($validForm) {
    // Create db connection
    include '../includes/db-connect.php';
    // Check whether email address has already been registered in the database
    $stmt = $mysqli->prepare("SELECT email FROM agents WHERE email = ?");
    $stmt->bind_param("s", $_POST["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        // if email has not previously been registered, add new user details to database
        $stmt1 = $mysqli->prepare("INSERT INTO agents (first_name, surname, email, phone, description, area_id, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt1->bind_param("sssssis", $_POST['firstName'], $_POST['surname'], $_POST['email'], $_POST['phone'], $_POST['agentDes'], $_POST['area'], $image_name);
        if (!$stmt1->execute()) {
            // if insert is unsuccessful throw error
           header('location: ../dashboard-add-agent');
           //$_SESSION["errorMessage"] = "<div class='error-message'>An error has occurred: " . $stmt1->errno . " " . $stmt1->error. "</div>";
           exit;
           }
           $stmt1->close();
    } else {
        // if email already exists in db, throw error
        header('location: ../dashboard-add-agent');
        $_SESSION["emailError"] = "<div class='validate-error-message'>Oops, this email address is already registered with another Agent</div>";
        exit;
        }
        $stmt->close();
} else {
    // if form does not pass validation redirect back to registration page
    header('Location: ../dashboard-add-agent');
    exit;
  }

// Get the just created listing_id and save to a variable
$new_agent_id = mysqli_insert_id($mysqli);

// if agent is successfully created go back to dashboard 'add agent' page and print success message
$_SESSION["successMessage"] = "<div class='success-message'>New Agent with ID: " . $new_agent_id . " successfully created.</div>";
header('location: ../dashboard-add-agent');

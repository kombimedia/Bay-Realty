<?php
session_start();
include 'process-functions-validation.php';

// Save form data to global variables to repopulate form if submit fails
$_SESSION['storeFirstName'] = $_POST['contactFirstName'];
$_SESSION['storeSurname'] = $_POST['contactSurname'];
$_SESSION['storeEmail'] = $_POST['contactEmail'];
$_SESSION['storePhone'] = $_POST['contactPhone'];
$_SESSION['storeMessage'] = $_POST['contactMessage'];

// Validate input fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // validate first name
    $validName = true;
    if (!validate_name ($_POST["contactFirstName"], "firstNameError", "first name")) {
        $validName = false;
    }

    // Validate surname
    $validSName = true;
    if (!validate_name ($_POST["contactSurname"], "surnameError", "surname")) {
        $validSName = false;
    }

    // Validate email address
    $validEmail = true;
    if (!validate_email ($_POST["contactEmail"])) {
        $validEmail = false;
    }

    // Validate phone
    $validPhone = true;
    if (!validate_phone ($_POST["contactPhone"])) {
        $validPhone = false;
    }

    // Valid entry message
    $validMessage = true;
    if (!validate_input_field($_POST["contactMessage"], "messageError", $validMessage, "contact message", "500")) {
        $validMessage = false;
    }
}

// If all validation passes set validForm variable to true
$validForm = $validName && $validSName && $validEmail && $validPhone && $validMessage;

if ($validForm) {
    $_SESSION["successMessage"] = "<div class='success-message'>Thank you for contacting us " . $_POST['contactFirstName'] . ". We will get back to you ASAP.</div>";
    // Once contact form is processed and success message is printed, clear form fields
    unset($_SESSION['storeFirstName']);
    unset($_SESSION['storeSurname']);
    unset($_SESSION['storeEmail']);
    unset($_SESSION['storePhone']);
    unset($_SESSION['storeMessage']);
    header('location: ../contact-us');
    // Send contact form notification to admins
    include 'process-send-contact-email.php';
} else {
    header('location: ../contact-us');
}



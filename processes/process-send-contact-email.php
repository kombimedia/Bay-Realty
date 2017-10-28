<?php
// define email variables
$fromEmail = "info@bayrealty.co.nz";
$fromName = "Bay Realty";
$adminEmail = "cykiwi@yahoo.com";
$adminFirstName = "Cy";
$adminSurName = "Messenger";
$userEmail = ($_POST['contactEmail']);
$userFirstName = ($_POST['contactFirstName']);
$userSurName = ($_POST['contactSurname']);
$userPhone = ($_POST['contactPhone']);
$userMessage = ($_POST['contactMessage']);
$headers = "To: ".$adminFirstName." " .$adminSurName." <".$adminEmail."> \r\n";
$headers .= "From: ".$fromName." <".$fromEmail."> \r\n";
$headers .= 'Cc: danejbay@yahoo.com' . "\r\n";
$headers .= "MIME-Version: 1.0 \r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";
// construct contact form notification email
$subject = "Message from " . $userFirstName . " " . $userSurName . " via the contact form";
$message = "
<p><b>Name: </b>" . $userFirstName . " " . $userSurName . "</p>
<p><b>Phone: </b>" . $userPhone . "</p>
<p><b>Email: " . $userEmail . "</b></p>
<p>" . $userMessage . "</p>"
;
// Send email via PHP mail function
mail("", $subject, $message, $headers);

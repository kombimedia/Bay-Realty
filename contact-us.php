<?php
session_start();
$title = "Bay Realty - Contact Us";
$metaD = "contact us page";
include 'includes/header.php';
?>

<div class="container contact-content-container">
    <h1 class="mb-3">Contact Bay Realty</h1>
    <div class="row">
      <div class="col-12 col-lg-6 contact-form">
          <form class="contact-form mb-3" method="post" role="form" action="processes/process-contact-us.php">
            <div><?php if (isset($_SESSION['successMessage'])) { echo $_SESSION['successMessage']; unset($_SESSION['successMessage']); }; ?></div>

            <div class="form-row form-inline">
              <div class="col-12 col-md-6">
                <label for="contact-first-name" class="sr-only">First Name</label>
                <input type="text" id="contact-first-name" name="contactFirstName" class="form-control wide mb-2" placeholder="First name" required autofocus value="<?php if (isset($_SESSION['storeFirstName'])) { echo $_SESSION['storeFirstName']; unset($_SESSION['storeFirstName']); }; ?>">
                <div><?php if (isset($_SESSION['firstNameError'])) { echo $_SESSION['firstNameError']; unset($_SESSION['firstNameError']); }; ?></div>
              </div>
              <div class="col-12 col-md-6">
                <label for="contact-surname" class="sr-only">Surname</label>
                <input type="text" class="form-control wide mb-2" name="contactSurname" id="contact-surname" placeholder="Surname" required value="<?php if (isset($_SESSION['storeSurname'])) { echo $_SESSION['storeSurname']; unset($_SESSION['storeSurname']); }; ?>">
                <div><?php if (isset($_SESSION['surnameError'])) { echo $_SESSION['surnameError']; unset($_SESSION['surnameError']); }; ?></div>
              </div>
            </div>

            <label for="contact-phone" class="sr-only">Phone</label>
            <input type="text" id="contact-phone" name="contactPhone" class="form-control mb-2" placeholder="Phone number - (021)1234567" required value="<?php if (isset($_SESSION['storePhone'])) { echo $_SESSION['storePhone']; unset($_SESSION['storePhone']); }; ?>">
            <div><?php if (isset($_SESSION['phoneError'])) { echo $_SESSION['phoneError']; unset($_SESSION['phoneError']); }; ?></div>

            <label for="contact-email" class="sr-only">Email</label>
            <input type="email" id="contact-email" name="contactEmail" class="form-control mb-2" placeholder="Email" required value="<?php if (isset($_SESSION['storeEmail'])) { echo $_SESSION['storeEmail']; unset($_SESSION['storeEmail']); }; ?>">
            <div><?php if (isset($_SESSION['emailError'])) { echo $_SESSION['emailError']; unset($_SESSION['emailError']); }; ?></div>

            <label for="contact-message" class="sr-only">Message</label>
            <textarea rows="6" class="form-control mb-2" name="contactMessage" id="contact-message" required placeholder="Message"><?php if (isset($_SESSION['storeMessage'])) { echo $_SESSION['storeMessage']; unset($_SESSION['storeMessage']); }; ?></textarea>
            <div><?php if (isset($_SESSION['messageError'])) { echo $_SESSION['messageError']; unset($_SESSION['messageError']); }; ?></div>

            <button class="btn btn-md btn-block" type="submit">Send Inquiry</button>
          </form>
      </div>

      <div class="col-12 col-lg-6">
        <div class="contact-map mb-3" id="map"></div>
      </div>
    </div>
</div>

<script>
function initMap() {
var headOffice = {lat: -37.690429 , lng: 176.1678983};
var map = new google.maps.Map(document.getElementById('map'), {
  zoom: 16,
  center: headOffice
});
var marker = new google.maps.Marker({
  position: headOffice,
  map: map
});
}
</script>
<script async defer
src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBMqh-VZSDxYkS4Gm8baEjOCnYOItBi4jQ&callback=initMap'>
</script>




<?php
  include 'includes/footer.php';
?>

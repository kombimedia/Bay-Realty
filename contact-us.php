<?php
$title = "Bay Realty - Contact Us";
$metaD = "contact us page";
include 'includes/header.php';
?>


<div class="container contact-content-container">
    <h1 class="mb-3">Contact Bay Realty</h1>
    <div class="row">
      <div class="col-12 col-lg-6 contact-form">
          <form class="contact-form mb-3" method="post" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="contact-first-name" class="sr-only">Full Name</label>
            <input type="text" id="contact-first-name" name="contactName" class="form-control mb-2" placeholder="Full name" required autofocus>
            <label for="contact-phone" class="sr-only">Phone</label>
            <input type="text" id="contact-phone" name="contactPhone" class="form-control mb-2" placeholder="Phone number" required>
            <label for="contact-email" class="sr-only">Email</label>
            <input type="email" id="contact-email" name="contactEmail" class="form-control mb-2" placeholder="Email" required>
            <label for="contact-message" class="sr-only">Message</label>
            <textarea rows="6" class="form-control mb-2" name="contactMessage" id="contact-message" required  placeholder="Message"></textarea>
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

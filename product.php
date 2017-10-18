<?php
$title = "Bay Realty - Product Page";
$metaD = "Product page";
include 'includes/header.php';
include 'includes/search.php';
?>

<?php
include 'processes/process-populate-product.php';
include 'processes/process-populate-image-carousel.php';
?>

<div class="container-fluid">
<div class="container slider-inner">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
    <!-- <li data-target="#carouselExampleIndicators" data-slide-to="2"></li> -->
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="images/uploads/<?php echo $featured_image ?>" alt="First slide">
    </div>
    <?php echo $display_image ?>
    <!-- <div class="carousel-item">
      <img class="d-block w-100" src="..." alt="Third slide">
    </div> -->
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</div>
<table>
<?php echo $display_product ?>
</table>
<table>
<?php echo $display_image ?>
</table>
      <div class="container content-widget">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="home-widget-top">
              <h2>About Property</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="home-widget-top">
              <h2>Map</h2>
            </div>
          </div>
        </div>
      </div>
          <div class="container content-widget">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-top">
              <h2>Office</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-top">
              <h2>Agent</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-top">
              <h2>Agent</h2>
            </div>
          </div>
        </div>
      </div>

<?php
  include 'includes/footer.php';
?>

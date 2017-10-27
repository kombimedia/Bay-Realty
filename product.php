<?php
$title = "Bay Realty - Product Page";
$metaD = "Product page";
include 'includes/header.php';
include 'includes/search.php';
?>

<?php
include 'processes/process-populate-product.php';
include 'processes/process-populate-image-carousel.php';
include 'processes/process-populate-agent.php';
?>

<div class="container product-full">
  <div class=" slider-inner">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
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

<div class="col" id="product_content">
  <div class="row">
    <div class="col">
     <table>
       <?php echo $display_product ?>
     </table>
   </div>
 </div>
 <div id="product-2" class="row no-gutters">
  <div class=" col-lg-9 col-md-9 display-block-2">
    <table>
      <?php echo $display_product2 ?>
    </table>
  </div>

  <div  id="product-3" class=" col-lg-3 col-md-3">
    <table>
      <?php echo $display_product3 ?>
    </table>
  </div>
</div>
<div class=" col" id="product-map-agent">
<div  class="row">
  <div class=" col-lg-4 col-md-4 agent">
    <div class="contact-agent">
      <h4>Contact-details</h4>
    </div>
    <div class="agent-data">
    <?php echo $display_agent ?>
  </div>
  </div>
  <div class=" col-lg-8 col-md-8 display-block-3 ">
<?php echo $display_map ?>
</div>
</div>
</div>
</div>

</div>

<?php
include 'includes/footer.php';
?>

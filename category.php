<?php
$title = "Bay Realty - Category Page";
$metaD = "Category page";
include 'includes/header.php';
include 'includes/search.php';
?>


      <div class="container content-widget">
        <div class="row">
          <div class="col">
                       <div class="page-content-top">
                         <h2 class="text-center">Featured Properties</h2>

              
<?php

include 'includes/featured-listings.php';
?>

            </div>
          </div>
         
        </div>
      </div>
    </div>

  <div class="container-fluid">
      <div class="container property-listings-home">
        <div class="row">
          <div class="col property-listings-home-div">
            <div class="home-widget-listings">
              <h2 class="text-center" >Listed Properties</h2>



            </div>
          </div>
        </div>
      </div>
    </div>

<?php
  include 'includes/footer.php';
?>

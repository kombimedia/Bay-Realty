<?php
session_start();
 $search_output = $_SESSION['search_output'] ;
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


                   
                      
<table>
   

 <?php echo $search_output ?>



</table>

   
<?php
  include 'includes/footer.php';
?>

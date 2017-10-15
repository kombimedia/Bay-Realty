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
   <?php

        if (isset($_POST['submit-search'])) {
          $search = mysqli_real_escape_string($mysqli, $POST['/category/search-bar']);
          $sql = "SELECT * FROM properties WHERE title LIKE '%$search%' OR title LIKE '%$search%' ";




        }
                    echo "<div class='col col-sm-12 col-md-6 col-lg-4 col-xl-4  property-listing-table'>";
                    echo "<div class='card' style='width: 20rem;'>";
                    echo "<table>";
                    echo "<tr><td><img class='card-img-top' src='images/uploads/" .$row['featured_image'] . "' alt='Card image cap''><td>";
                    echo "</tr>";
                    echo "<div class='card-block'>";
                    echo "<tr>";
                    echo "<td><div class='card-data'><h4 class='card-title' >" . $row['title'] . "</h4><span>" . $row['address'] . "<br><span>Price: $" . $row['price'] . "</span><br><span> <i class='fa fa-bed' aria-hidden='true'></i> : " . $row['bed_no'] . " " .  "<i class='fa fa-bath' aria-hidden='true'></i>  :  " . $row['bath_no']  . " " .  "<i class='fa fa-car' aria-hidden='true'></i>  :  " . $row['garage_no'] . "</span></div></td>";
                    echo "</tr>";


                    echo "</div>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
          }
  } else {
        echo "0 results";
    }
?>


            </div>
          </div>
        </div>
      </div>
    </div>

<?php
  include 'includes/footer.php';
?>

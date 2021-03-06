<?php
include 'includes/db-connect.php';
session_start();
if (isset($_SESSION['guestUserName'])) {
  //$listing_id = $_SESSION['listing_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Bay Realty home page">
    <title>Bay Realty | Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/homepage.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Baumans" rel="stylesheet">
  </head>
  <body>

      <?php
        include 'includes/nav.php';
      ?>

    <div class="home-image full-height">
      <div class="home-image-widget">
          <img class="img-fluid" src="images/bay-realty-logo.png">
        <h1>The Best In The Bay</h1>
      </div>
      <div class="container home-search-box">
        <?php
          include 'includes/search.php';
        ?>
      </div>
    </div>
    <!-- Home widget top area -->
    <div class="container-fluid home-widget-top-background" id="featured-container">
      <div class="container home-widget-top-container">
        <div class="row">
          <!-- <div class="col"> -->
            <div class="home-widget-top">
              <h1 class="text-center" >Featured Properties</h1>
              <?php include 'includes/featured-listings.php'; ?>
            </div>
          <!-- </div> -->
        </div>
      </div>
    </div>

    <!-- Home widget bottom area - property listings -->

       <div class="container property-listing-div">

              <h1 class="text-center">Current Listings</h1>
              <div class="row no-gutters">
   <?php

   $stmt = $mysqli->prepare("SELECT listing_id, address, price, bed_no, bath_no, featured_image, title, garage_no, sell_method FROM properties ORDER BY RAND()");
 $stmt->execute();
     $result = $stmt->get_result();
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {

            // currency
            $number = $row['price'];
            setlocale(LC_MONETARY,"en_NZ");
            $price = money_format("%.0n", $number);

            // Display the sell method if populated in listing
            if ($row['sell_method'] !== "") {
                $price = $row['sell_method'];
            }

            $listing_id = $row['listing_id'];
                    echo "<div class='col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xl-4  property-listing-table'>";
                    echo "<div class='card'>";
                    echo "<table>";


                    echo "<tr><td><a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><img class='card-img-top' src='images/uploads/" .$row['featured_image'] . "' alt='Card image cap''></a></td>";

                    echo "</tr>";
                    echo "<div class='card-block'>";
                    echo "<tr>";
                    echo "<td><div class='card-data'><a class='view-listing' href='product.php?listing_id=$listing_id#product_page'><h4 class='card-title' >" . $row['title'] . "</h4></a><span>" . $row['address'] . "<br><span>" . $price . "</span><br><span> <i class='fa fa-bed pr-2' aria-hidden='true'></i>" . $row['bed_no'] . " " .  "<i class='fa fa-bath pl-2 pr-2' aria-hidden='true'></i>" . $row['bath_no']  . " " .  "<i class='fa fa-car pl-2 pr-2' aria-hidden='true'></i>" . $row['garage_no'] . " <a style='float: right' class= 'wishlist-icon' href='processes/process-wishlist-button.php?listing_id=$listing_id' action= 'post' ><i class='fa fa-heart' aria-hidden='true'> </i></a>" . "</span></div></td>";

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

    <?php include 'includes/footer.php'; ?>

  </body>
</html>

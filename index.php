<?php
  include 'includes/db-connect.php';
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
    <div class="container-fluid">
      <div class="container home-widget-top-container">
        <div class="row">
          <div class="col">
            <div class="home-widget-top">
              <h2>Featured Property</h2>

<?php

include 'includes/featured-listings.php';
?>

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Home widget bottom area - property listings -->
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 1</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 2</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 3</h2>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 4</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 5</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 6</h2>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 7</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 8</h2>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="home-widget-bottom">
              <h2>Property 9</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
      include 'includes/footer.php';
    ?>
  </body>
</html>

<?php
  include 'includes/db-connect.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- Set default page meta and title -->
      <meta name="description" content="<?php
      if(isset($metaD) && !empty($metaD)) {
         echo $metaD;
      } else {
         echo "Bay Realty - the best in the bay";
      } ?>" />
      <title><?php
      if(isset($title) && !empty($title)) {
         echo $title;
      } else {
         echo "Bay Realty";
      } ?></title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Baumans" rel="stylesheet">
  </head>

  <body>
    <?php
    include 'includes/nav.php';
    ?>
    <div class="container-fluid">
      <div class="row">
        <div class="header-image">
          <div class="page-image-widget">
            <a href="/bay-realty"><img class="img-fluid" src="images/bay-realty-logo.png"></a>
            <h1>The Best In The Bay</h1>
          </div>
        </div>
      </div>
    </div>


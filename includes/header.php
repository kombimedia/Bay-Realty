<?php
	include 'includes/db-connect.php';
?>



<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>

   

  <body>
  	<?php
	include 'includes/nav.php';
?>

 <div class="jumbotron" style="height: 300px">
 	</div>



    <!-- Main jumbotron for a primary marketing message or call to action -->





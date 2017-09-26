<?php
  include 'includes/db-connect.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php
    if(isset($metaD) && !empty($metaD)) {
       echo $metaD;
    } else {
       echo "Bay Realty - Admin dashboard";
    } ?>" />
    <title><?php
    if(isset($title) && !empty($title)) {
       echo $title;
    } else {
       echo "Admin Dashboard";
    } ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top">
      <a class="navbar-brand" href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
      <div class="welcome ml-auto">Welcome 'your name'</div>
    </nav>
  <div class="container-fluid">
    <div class="row">
      <main class="col-9 ml-auto col-md-10 pt-3" role="main">


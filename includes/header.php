<?php
include("includes/handlers/config.php");
include("includes/classes/User.php");
include("includes/classes/playlist.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Songs.php");

if (isset($_SESSION['userLoggedIn'])) {
  $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
  $username = $userLoggedIn->getUsername();
  echo "<script> userLoggedIn = '$username';</script>";
} 
else {
  header("Location: register.php");
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Slutify</title>

    <link rel="stylesheet" type="text/css" href="includes/assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="includes/assets/js/script.js"></script>

    <!-- Bootstrap 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
  </head>
  <body>

    <div id="mainContainer">

      <div id="topContainer">
        
        <?php  include("includes/navBarNavigator.php") ?>

        <div id="mainViewContainer">

          <div id="mainContent">
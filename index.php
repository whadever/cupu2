<?php
  // Initialize a session.
  if(!isset($_SESSION['userid'])){
  	session_start();
  }
  

    require_once("./includes/config.php");
?>
  <?php include('includes/header.php') ?>

 <?php
    if (isset($_GET["login"])) {include "login.php";}
    elseif(isset($_GET["register"])) {include "register.php";}
    elseif(isset($_GET["manageuser"])) {include "manageuser.php";}
    elseif(isset($_GET["edituser"])) {include "edituser.php";}
    elseif(isset($_GET["managequestion"])) {include "managequestion.php";}
    elseif(isset($_GET["managetests"])) {include "managetests.php";}
    elseif(isset($_GET["addtest"])) {include "addtest.php";}
    else {include "home.php";}
  ?>

  <?php include('includes/footer.php') ?>


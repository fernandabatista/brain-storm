<?php
  require "authenticate.php";
  if(!$login){
    header("Location: home.php");
    exit();
  }
?>

<?php
  if(!isset($_SESSION)){
    session_start();
  }
  if (isset($_SESSION["user"]) && isset($_SESSION["name"])) {
    $login = true;
    $user = $_SESSION["user"];
    $user_name = $_SESSION["name"];
    $tipo = $_SESSION["tipo"];
  }
  else{
    $login = false;
  }
  
?>

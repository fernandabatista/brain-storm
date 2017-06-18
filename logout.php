<?php
<<<<<<< HEAD
  session_start();
  session_unset();
  session_destroy();
  header("Location: home.php");
?>
=======
require "links.php";
  session_start();

  session_unset();

  session_destroy();

  header("Location: " . $path . "/login.php");
?>
>>>>>>> 6411fac3b1224d4a54e238861531fb92d8d25632

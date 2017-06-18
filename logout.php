<?php
require "links.php";
  session_start();

  session_unset();

  session_destroy();

  header("Location: " . $path . "/login.php");
?>
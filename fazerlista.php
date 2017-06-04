<?php

  require_once "selections.php";
  require_once "insertions.php";
  require_once "html_funcs.php";
  require "authenticate.php";
  html_header("style2.css");
  echo breadcumb(2,$_SESSION['cid']);
  if($_SERVER['REQUEST_METHOD']=='POST'){
    comparar($_SESSION['cid'],$_POST['selected']);
  }
?>
  <div class='container' id='pageContent'>
  <?php
    exerciciosLista($_GET['id'],true);
  ?>
  </div>
<?php html_closing() ?>

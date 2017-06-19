<?php

  //require "force_authenticate.php";
  require_once "selections.php";
  require_once "insertions.php";
  require_once "html_funcs.php";
  require "authenticate.php";

  if(!$login)
  html_header("style2.css",false);
  else
  html_header("style2.css",true);
  //echo breadcumb(2,$_SESSION['cid']);
  if($_SERVER['REQUEST_METHOD']=='POST'){
    // echo $_POST['selected'][0];
    // echo $_POST['selected'][1];
    $s=comparar($_POST['id'],$_POST['selected']);
  }

  echo breadcrumb("","","FAZER LISTA");
?>
  <div class='container' id='pageContent'>
  <?php
  if($_SERVER['REQUEST_METHOD']=='POST')
    echo $s;
  else
    echo exerciciosLista($_GET['id'],true);
  ?>
  </div>
<?php html_closing() ?>

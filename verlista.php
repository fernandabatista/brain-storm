<?php
  require "force_authenticate.php";
  require_once "selections.php";
  require_once "insertions.php";
  require_once "html_funcs.php";
  require "authenticate.php";
  html_header("style2.css");
  echo breadcrumb("","","VER LISTA");
?>
  <div class='container' id='pageContent'>

  <?php if(!$_SESSION['tipo']):?>
    <div class='row'>
      <h3>PARA COMPARTILHAR:</h3>
      <?=$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/fazerlista?id=".$_GET['id']?>
    </div>
    <br/>
  <?php

    endif;
    echo exerciciosLista($_GET['id']);
  ?>
  </div>
<?php html_closing() ?>

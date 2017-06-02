<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  require_once "links.php";
  html_header("style2.css");
  echo breadcumb(2,$_GET['id']);
?>
  <div class='container' id='pageContent'>
  <div class='row'>
    <a href='<?=$path?>/lista.php'><button type='button' class='btn btn-default col-sm-6 col-sm-offset-3'><span class="glyphicon glyphicon-plus fleft">
                </span>NOVO EXERCÍCIO</button></a>
  </div>
  <div class='row'>
    <button type='button' class='btn btn-default col-sm-6 col-sm-offset-3'><span class="glyphicon glyphicon-plus fleft"></span>NOVA LISTA</button>
  </div>
  <br/>
  <?= exercicios($_GET['id']); ?>
  </div>
<?php html_closing() ?>

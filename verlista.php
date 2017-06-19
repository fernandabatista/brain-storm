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
  echo breadcrumb("","","VER LISTA");
?>
  <div class='container' id='pageContent'>

  <?php if($login&&!$tipo):?>
    <div class='row'>
      <h3>PARA COMPARTILHAR:</h3>
      <?=$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])."/verlista.php?id=".$_GET['id']?>
    </div>
    <br/>
  <?php else: ?>

  <a href="fazerlista.php?id=<?=$_GET['id']?>"><button class='col-sm-6 col-sm-offset-3 btn btn-default'>FAZER</button></a>
  <br/>
  <br/>
  <?php endif; ?>
  <?=exerciciosLista($_GET['id']);?>
  </div>
<?php html_closing() ?>

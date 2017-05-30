<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  html_header("style2.css");
  echo breadcumb(2,$_GET['id']);
?>
  <div class='container' id='pageContent'>
  <?= exercicios($_GET['id']); ?>
  </div>
<?php html_closing() ?>

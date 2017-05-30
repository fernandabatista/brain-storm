<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  html_header("style.css");
  echo breadcumb(1,$_GET['id']);
?>
  <div class='container' id='pageContent'>
  <?= assuntos($_GET['id']); ?>
  </div>
<?php html_closing() ?>

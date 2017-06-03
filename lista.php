<?php
  require "selections.php";
  require  "html_funcs.php";
  html_header("style2.css");

  echo breadcumb(2,$_GET['id']);
?>
  <div class='container' id='pageContent'>
  <?= exercicios($_GET['id'],true); ?>

  </div>
<?php html_closing() ?>

<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  require_once "authenticate.php";
  html_header("style.css");
  echo breadcumb(0,$_GET['id']);
?>
  <div class='container' id='pageContent'>

  <?= disciplinas($_GET['id']); ?>

  </div>
<?php html_closing() ?>

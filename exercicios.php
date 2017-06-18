<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  require_once "links.php";
  html_header("style2.css");
  echo breadcumb(2,$_GET['id']);
?>

<?php html_closing() ?>

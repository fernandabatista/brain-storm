<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  html_header("style.css");
  nav();
?>
<div class='container' id='pageContent'>

  <?= tableCurso(); ?>


</div>
<?php echo html_closing();?>

<?php
  require "selections.php";
  require "html_funcs.php";
  html_header("style.css");
  nav();
?>
<div class='container' id='pageContent'>

  <?= tableCurso(); ?>


</div>
<?php echo html_closing();?>

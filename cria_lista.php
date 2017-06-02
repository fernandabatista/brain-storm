<?php
  if(!empty($_POST['check_list'])){
    $ins=true;
  }
  require_once "selections.php";
  require_once "insertions.php";
  require_once "html_funcs.php";
  html_header("style2.css");
  echo breadcumb(2,$_GET['id']);
?>
  <div class='container' id='pageContent'>
  <?php
  if($ins)
      cria_lista($_POST['check_list'])?>
  </div>
<?php html_closing() ?>

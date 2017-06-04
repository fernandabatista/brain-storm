<?php
  require "selections.php";
  require "html_funcs.php";
  html_header("style.css");
  $id=0;
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    echo calls($_GET['act'],$id,true);
  }
?>
<div class='container' id='pageContent'>

  <?php
  echo calls($_GET['act'],$id);

  ?>


</div>
<?php echo html_closing();?>

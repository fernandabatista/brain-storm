<?php

  require "selections.php";
  require  "insertions.php";
  require "authenticate.php";
  require "html_funcs.php";
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(count($_POST['check_list']>0)){
      echo
        cria_lista($cid,$_POST['check_list'],$_POST['name']);

    }
  }
  html_header("style2.css");
  echo breadcumb(2,$_GET['id']);
?>
  <div class='container' id='pageContent'>
  <?= exercicios($_GET['id'],true); ?>

  </div>
  <script>
  $(function(){
    var ret=true;
    $("#form-test").on("submit",function(){
      nome_input = $("input[name='name']");
      if(nome_input.val() == "" || nome_input.val() == null)
      {

        $("#nome").addClass("has-error");
        ret=false;
      }
      return(ret);
    });
  });
  </script>
<?php html_closing() ?>

<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  html_header("style.css",false);
  echo admnav();

  if($_SERVER['REQUEST_METHOD']=="POST"){
    require "insertions.php";
    novoprof($_POST['Nome'],$_POST['email'],$_POST['senha']);
    header("Location: adm_listap.php");
    exit();
  }

  if(isset($_GET['act'])&&isset($_GET['id'])){
    if($_GET['act']=="excluir"){
      require "deletions.php";
      deletaprof($_GET['id']);
    }
  }


?>
<div class='container' id='pageContent'>

    <?php

			professores();
		?>
    <div class='row'>
      <form class="hidden col-sm-6 col-sm-offset-3 " id="hdnform" action"<?=$_SERVER['PHP_SELF']?>" method="POST">
        <div class='row'>
          <div class=" form group col-sm-6 col-sm-offset-3">
            <label for="Nome">Nome:</label>
            <input class='center form-control' type='text' required name="Nome"></input>
          </div>
        </div>
        <div class='row'>
          <div class="form group col-sm-6 col-sm-offset-3">
            <label for="email">E-mail:</label>
            <input class='center form-control' type='email' required name="email"></input>
          </div>
        </div>
        <div class='row'>
          <div class="form group col-sm-6 col-sm-offset-3">
            <label for="senha">Senha:</label>
            <input class='center form-control' type='text' required name="senha"></input>
          </div>
        </div>
        <br/>
        <button type="submit" class="btn btn-default">CRIAR</button>
      </form>
      <button id="hide" class="btn btn-default col-sm-4 col-sm-offset-4">NOVO PROFESSOR</button>
    </div>
</div>
<?php echo html_closing();?>

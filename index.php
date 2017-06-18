<?php

  require "selections.php";
  require "insertions.php";
  require "html_funcs.php";
  require "authenticate.php";
  require "force_authenticate.php";
  html_header("style.css");
  if(!$login){
    die("Você não tem permissão para acessar essas página.");
  }

  if($_SERVER['REQUEST_METHOD']=="POST"){
    $tagid=0;
    if(isset($_POST['tag']))
      $tagid=$_POST['tag'];
    else
      $tagid=$_POST['id'];

    novo($_POST['act'],$tagid,$_POST['nome']);
  }

  $id=0;
  $act=$_GET['act'];
  if(isset($_GET['id'])){
    $id=$_GET['id'];

    if($act=="scurso"){
      salva_curso($id);
      $act="curso";
    }

    echo breadcrumb($_GET['act'],$id);

  }else if($_GET['act']=="listas"){
    echo breadcrumb("","","MINHAS LISTAS");
  }
?>

<div class='container' id='pageContent'>
<?php if($tipo == '0'): ?>
  <?php if($act=="curso"||$act=="disciplina"||$act=="assunto"):?>

    <div class='row'>
      <form id="hdnform" class='col-sm-4 col-sm-offset-4 hidden'
       action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>

        <input name="id" value="<?=$id?>" type="hidden"/>
        <input name="act" value="<?=$act?>" type="hidden"/>

        <?php if($act == "curso"): ?>
          <div class="form-group  " >
            <label for="nome">Abreviação:</label>
            <input type="text" name="tag"  class="form-control center"></input>
          </div>
        <?php endif ?>

        <div class="form-group" >
            <label for="nome">Nome:</label>
          <div class="input-group">

        		<input name= 'nome' type="text"
              class="form-control" id="" required>
            </input>
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="submit">
                <span class='glyphicon glyphicon-ok'></span>
              </button>
            </span>
          </div>
        </div>
      </form>
      <button class="btn btn-default col-sm-4 col-sm-offset-4"id="hide">
        CRIAR <?= strtoupper($act)?>
      </button>
    </div>
    <br><br>

    <?php endif?>
    <?php endif?>

  <?php


    echo calls($act,$id);

  ?>


  </div>
<?php echo html_closing();?>

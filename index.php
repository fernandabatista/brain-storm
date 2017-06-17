<?php
  require "selections.php";
  require "insertions.php";
  require "html_funcs.php";
  html_header("style.css");
  $id=0;
  $act=$_GET['act'];
  if(isset($_GET['id'])){
    $id=$_GET['id'];

    if($act=="scurso"){
      salva_curso($id);
      $act="curso";
    }
    echo calls($_GET['act'],$id,true);

  }
?>

<div class='container' id='pageContent'>

  <?php if($act=="curso"||$act=="disciplina"||$act=="assunto"):?>

    <div class='row'>
      <form id="hdnform" class='col-sm-4 col-sm-offset-4 hidden'
       action="<?= $_SERVER['PHP_SELF'] ?>" method='post'>

        <input name="id" value="<?=$id?>" type="hidden"/>
        <input name="act" value="<?=$act?>" type="hidden"/>

        <?php if($act == "curso"): ?>
          <div class="form-group " >
            <label for="nome">Abreviação:</label>
            <input type="text" name="tag"  class="form-control"></input>
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
        CRIAR <?= strtoupper($_GET['act'])?>
      </button>
    </div>
    <br><br>

  <?php endif?>

  <?php

    echo calls($act,$id);

  ?>


</div>
<?php echo html_closing();?>

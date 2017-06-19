<?php
  require "selections.php";
  require "html_funcs.php";
  require "authenticate.php";
  html_header("style.css");
  $result="";
  echo breadcrumb("","","PESQUISAR");
  if($_SERVER['REQUEST_METHOD']=="POST"&&isset($_POST['optradio'])&&isset($_POST['search'])){

    $result = pesquisa($_POST['optradio'],$_POST['search']);
  }
?>
<div class='container' id='pageContent'>

  <div class='row center'>

    <form class='col-sm-6 col-sm-offset-3'  action='pesquisar.php' method='post'>
    <div class="form-group ">
      <label for="search">Pesquisa:</label>
      <input name= 'search' type="text" class="form-control center" placeholder="Insira o texto a ser pesquisado..." id="email" required>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="optradio" value="Curso">CURSOS</label>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="optradio" value="Disciplina">DISCIPLINAS</label>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="optradio" value="Assunto">ASSUNTOS</label>
    </div>
    <div class="radio-inline">
      <label><input type="radio" name="optradio" value="exercicio">EXERCÍCIOS</label>
    </div>
    <br/>
    <button type="submit" class="btn btn-default"><span class='glyphicon
        glyphicon-search'></span>PESQUISAR</button>

    </form>

  </div>

  <?php
    echo $result;
  ?>


</div>
<?php echo html_closing();?>

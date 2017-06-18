<?php
  require "force_authenticate.php";
  require_once "selections.php";
  require "insertions.php";
  require "html_funcs.php";
  require "authenticate.php";
  html_header("style.css");
  if($_SERVER['REQUEST_METHOD']=='POST'){
    cria_exercicio($_POST['id'],$_POST['name'],$_POST['a'],$_POST['optradio']);
  }
?>
<div class='container' id='pageContent'>

 <div><h3 class='slog'>Novo Exercício</h3></div>
	<div class='row center'>

		<form class='col-sm-6 col-sm-offset-3' action='create_exercicios.php' method='post'>
    <input name='id' type='hidden' value='<?=$_GET['id']?>'/>
    <div class="form-group ">
			<label for="enunciado">Enunciado</label>
			<textarea name='name' class="form-control" rows="5" id="exercicio"></textarea>
		</div>
		<label for="alternativas">Alternativas</label>
		<p>*Selecionar a correta</p>
		<div class="radio">
			<label>
        <input type="radio" name="optradio" value=1>
        <input name= 'a[]' type="text" class="form-group" value="" id="a1">
      </label>
		</div>
		<div class="radio">
			<label>
        <input type="radio" name="optradio"value=2 >
        <input name= 'a[]' type="text" class="form-group" value="" id="a2">
      </label>
		</div>
		<div class="radio">
			<label>
        <input type="radio" name="optradio"value=3>
        <input name= 'a[]' type="text" class="form-group" value="" id="a3">
      </label>
		</div>
		<div class="radio">
			<label>
        <input type="radio" name="optradio"value=4>
        <input name= 'a[]' type="text" class="form-group" value="" id="a4">
      </label>
		</div>
		<div class="radio">
			<label>
        <input type="radio" name="optradio"value=5>
        <input name= 'a[]' type="text" class="form-group" value="" id="a5">
      </label>
		</div>

		<button type="submit" class="btn btn-default">ENVIAR</button>
		</form>
	</div>


</div>
<?php echo html_closing();?>

<?php
  require "selections.php";
  require "html_funcs.php";
  html_header("style.css");
  nav();
?>
<div class='container' id='pageContent'>

 <div><h3 class='slog'>Novo Exercício</h3></div>
	<div class='row center'>

		<form class='col-sm-6 col-sm-offset-3' action='create_exercicios.php' method='post'>
		<div class="form-group ">
			<label for="enunciado">Enunciado</label>
			<textarea class="form-control" rows="5" id="exercicio"></textarea>
		</div>
		<label for="alternativas">Alternativas</label>
		<p>*Selecionar a correta</p>
		<div class="radio">
			<label><input type="radio" name="optradio"><input name= 'email' type="email" class="form-group" id="email"></label>
		</div>
		<div class="radio">
			<label><input type="radio" name="optradio"><input name= 'email' type="email" class="form-group" id="email"></label>
		</div>
		<div class="radio">
			<label><input type="radio" name="optradio"><input name= 'email' type="email" class="form-group" id="email"></label>
		</div>
		<div class="radio">
			<label><input type="radio" name="optradio"><input name= 'email' type="email" class="form-group" id="email"></label>
		</div>
		<div class="radio">
			<label><input type="radio" name="optradio"><input name= 'email' type="email" class="form-group" id="email"></label>
		</div>
		
		<button type="submit" class="btn btn-default">ENVIAR</button>
		</form>
	</div>


</div>
<?php echo html_closing();?>

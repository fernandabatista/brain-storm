<?php

  require "selections.php";
  require "html_funcs.php";
  html_header("style.css",false);
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		login($_POST['email'],$_POST['pwd']);
	}
?>
	<div><h3 class='slog'>LOREM IPSUM DOLOR SIT AMET</h3></div>
	<div class='row center'>

		<form class='col-sm-6 col-sm-offset-3' action='login.php' method='post'>
		<div class="form-group ">
			<label for="email">E-mail:</label>
			<input name= 'email' type="email" class="form-control center" id="email">
		</div>
		<div class="form-group">
			<label for="pwd">Senha:</label>
			<input name= 'pwd' type="password" class="form-control center" id="pwd">
		</div>
		<button type="submit" class="btn btn-default">CADASTRAR</button>
		</form>
	</div>
	<?php html_closing();?>

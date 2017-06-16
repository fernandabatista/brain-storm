<?php
  require_once "selections.php";
  require "insertions.php";
  require "html_funcs.php";
  require "authenticate.php";
  html_header("style.css");
   if($_SERVER['REQUEST_METHOD']=='POST'){
    cria_disciplina($_SESSION['cid'],$_POST['name']);
  }
?>
<div class='container' id='pageContent'>

 <div><h3 class='slog'>Nova Disciplina</h3></div>
	<div class='row center'>

		<form class='col-sm-6 col-sm-offset-3' action='create_disciplina.php' method='post'>
		<div class="form-group ">
			<label for="Nome">Nome</label>
			<input name='nome' class="form-control" rows="5">
		</div>
		<button type="submit" class="btn btn-default">ENVIAR</button>
		</form>
	</div>


</div>

<?php echo html_closing();?>


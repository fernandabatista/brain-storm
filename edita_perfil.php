<?php
  require "force_authenticate.php";
  require "update.php";

  require "selections.php";
  require_once "html_funcs.php";
  require_once "authenticate.php";
  html_header("style.css");
//  echo breadcumb(0,$_GET['id']);
  $_POST['nomea'] = $_SESSION['name']; //nomea = nome atual e depois nome atualizado
   if($_SERVER['REQUEST_METHOD']=='POST'){
    perfil($_SESSION['cid'],$_POST['nome'], $_POST['pwd'], $_FILES['arquivo']);
  $_POST['nomea'] = $_POST['nome'];
  }

?>
  <div class='container' id='pageContent'>

  <div class='row center'>

		<form class='col-sm-6 col-sm-offset-3' action='edita_perfil.php' method='post' enctype="multipart/form-data">
		<div class="form-group">
			<label for="foto">Avatar: </label>
			<input type="file" required name="arquivo">
		<div class="form-group ">
			<label for="nome">Nome:</label>
			<input name= 'nome' type="text" class="form-control center" id="user"
			value="<?= $_POST['nomea'] ?>">
		</div>
		<div class="form-group">
			<label for="pwd">Nova Senha:</label>
			<input name= 'pwd' type="password" class="form-control center" id="pwd">
		</div>
		<button type="submit" class="btn btn-default">CADASTRAR</button>
		</form>
	</div>

  </div>
<?php html_closing() ?>

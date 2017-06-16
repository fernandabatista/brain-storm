<?php
  require_once "selections.php";
  require_once "html_funcs.php";
  require_once "authenticate.php";
  html_header("style.css");
//  echo breadcumb(0,$_GET['id']);
   if($_SERVER['REQUEST_METHOD']=='POST'){
    perfil($_SESSION['cid'],$_POST['name'], $_POST['email'], $_POST['pwd'], $_POST['imagem']);
  }
?>
  <div class='container' id='pageContent'>

  <div class='row center'>

		<form class='col-sm-6 col-sm-offset-3' action='edita_perfil.php' method='post' enctype="multipart/form-data">
		<div class="form-group">
			<label for="foto">Avatar: </label>
			<input type="file" required name="imagem">
		<div class="form-group ">
			<label for="nome">Nome:</label>
			<input name= 'email' type="email" class="form-control center" id="user">
		</div>
		<div class="form-group ">
			<label for="email">E-mail:</label>
			<input name= 'email' type="email" class="form-control center" id="email">
		</div>
		<div class="form-group">
			<label for="pwd">Senha Antiga:</label>
			<input name= 'pwd' type="password" class="form-control center" id="pwd">
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

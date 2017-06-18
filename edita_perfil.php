<?php
<<<<<<< HEAD
  require "force_authenticate.php";
  require "update.php";

  require "selections.php";
  require_once "html_funcs.php";
  require_once "authenticate.php";
  html_header("style.css");
=======
	require "update.php";
	require "selections.php";
	require "html_funcs.php";
	require "authenticate.php";
	html_header("style.css");
>>>>>>> 46bbb80eb96c10b4e6399044abd229890456c414
//  echo breadcumb(0,$_GET['id']);
	$_POST['nomea'] = $_SESSION['name']; //nomea = nome atual e depois nome atualizado
    if($_SERVER['REQUEST_METHOD']=='POST'){
    perfil($_SESSION['cid'],$_POST['nome'], $_POST['pwd']);
  	$_SESSION['name'] = $_POST['nomea']= $_POST['nome'];
  		if (isset($_FILES['arquivo'])) {
  			mudafoto($_SESSION['cid'], $_FILES['arquivo']);
  	}
  	if (isset($_POST['pwd'])) {
				mudasenha($_SESSION['cid'], $_POST['pwd']);
				} 
  }
?>
<div class='container' id='pageContent'>
<div class='row center'>
	<form class='col-sm-6 col-sm-offset-3' action='edita_perfil.php' method='post' enctype="multipart/form-data">
		
		<div class="form-group ">
<<<<<<< HEAD
			<label for="nome">Nome:</label>
			<input name= 'nome' type="text" class="form-control center" id="user"
			value="<?= $_POST['nomea'] ?>">
=======
			<label for="nome">Editar Nome:</label>
			<input name= 'nome' type="text" class="form-control center" id="user" 
			value="<?= $_POST['nomea']; ?>">
>>>>>>> 46bbb80eb96c10b4e6399044abd229890456c414
		</div>
		<div class="form-group">
			<?php modal('senha', 'Mudar Senha', 'Mudar Senha'); ?>
			<label for="pwd">Nova Senha:</label>
			<input name= 'pwd' type="password" class="form-control center" id="pwd">

			<?php modal_footer('Concluido'); ?>
		</div>
		<div class="form-group">
			<?php modal('foto', 'Mudar Foto', 'Mudar Foto'); ?>
			<label for="arquivo">Avatar: </label>
			<input type="file"  name="arquivo">
			<?php modal_footer('Concluido');?>
		</div>
		<button type="submit" class="btn btn-default">CADASTRAR</button>
		</form>
</div>
</div>
<?php html_closing() ?>

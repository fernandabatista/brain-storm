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
    perfil($_SESSION['cid'],$_POST['nome']);
  	$_SESSION['name'] = $_POST['nomea']= $_POST['nome'];
  		if (isset($_FILES['arquivo'])) {
  			mudafoto($_SESSION['cid'], $_FILES['arquivo']);
  	}
  }
?>
<div class='container' id='pageContent'>
<div class='row center'>
	<form class='col-sm-6 col-sm-offset-3' action='edita_perfil.php' method='post' enctype="multipart/form-data">

		<div class="form-group ">
			<label for="nome">Editar Nome:</label>
			<input name= 'nome' type="text" class="form-control center" id="user"
			value="<?= $_POST['nomea']; ?>">
		</div>
	
		<div class="form-group">
			<label for="arquivo">Avatar: </label>
			<br><br>
			<?php $pic = '<div class="row"><img src="'.imagem($_SESSION['user']).'"
            class="col-sm-4 col-sm-offset-4 img-circle imgp" height="50%" width="50%" alt="Foto de perfil"></div>';
            echo $pic; ?>
			<input type="file"  name="arquivo">
		</div>
		<button type="submit" class="btn btn-default">CADASTRAR</button>
		</form>
</div>
</div>
<?php html_closing() ?>

<?php
	require "authenticate.php";

		if(isset($_SESSION['login'])){
			header("Location: index.php?act=curso");
			exit();
		}
	require "links.php";
  require "selections.php";
  require "html_funcs.php";
  html_header("style.css",false);
  if($login){
    header("Location: " . $path . "/index.php?act=curso");
      }
	if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['adm']))
      login($_POST['email'],$_POST['pwd'],true);
    else
		login($_POST['email'],$_POST['pwd']);
	}
?>
	<div><h3 class='slog'></h3></div>
	<div class='row center'>

		<form class='col-sm-6 col-sm-offset-3' action='login.php' method='post'>

    <?php if(isset($_GET['adm'])){
      echo "<input name='adm' value='1' type='hidden'/>";
    }?>

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

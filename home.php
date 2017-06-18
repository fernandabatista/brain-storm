<?php require_once "links.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Bootstrap Example</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
	<div class='jumbotron'><h1>BRAIN DEBUGGER</h1></div>
	<div><h3 class='slog'>LOREM IPSUM DOLOR SIT AMET</h3></div>
<div class='container'>

	<div class='row'>
		<span class="col-sm-3"></span>


		<div class="col-sm-3">
			<div class="panel panel-default hoverable"><a href="login.php">
				<div class="panel-heading">
					<div class="panel-body">
					<h3>Acessar como aluno</h3>
					</div>
				</div>
			</a></div>
		</div>


		<div class="col-sm-3">
			<div class="panel panel-default hoverable"><a href="login.php">
				<div class="panel-heading">
					<div class="panel-body">
						<h3>Acessar como professor</h3>
					</div>
				</div>
			</a></div>
		</div>


	</div>
	<div class='row' >
		<a class='cpointer' href='<?=$path?>/cadastrar.php'>Cadastrar-se</a><br/>
		<a class='cpointer' href='login.php?adm=1'>Acessar como administrador</a>
	</div>
</div>
</body>
</html>

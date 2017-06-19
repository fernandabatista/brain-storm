<?php
require "authenticate.php";

	if($login){
		header("Location: index.php?act=curso");
		exit();
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Brain Debugger</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
	<div class='jumbotron'><h1>BRAIN DEBUGGER</h1></div>

	<div class='container'>
	<div class='row'>
  <span class='col-sm-3'></span>
  <form class='col-sm-6' id='form-test' action='form_test.php' method='post'>
  <div class="form-group" id='nome'>
    <label for="name">Nome:</label>
		<input name='name' type="text"  class="form-control center" >
		<span id="erro-nome"></span>
	</div>
  <div class="form-group" id='email'>
    <label for="email">E-mail:</label>
    <input name="email" type="email"  class="form-control center" >
  </div>
  <div class="form-group" id='pwd'>
    <label for="pwd">Senha:</label>
    <input name="pwd" type="password" class="form-control center">
  </div>
  <button type="submit" class="btn btn-default">CADASTRAR</button>
  </form>
	<script>

         $(function(){
					 var ret=true;
           $("#form-test").on("submit",function(){
             nome_input = $("input[name='name']");
						 email_input = $("input[name='email']");
						 s_input = $("input[name='pwd']");
             if(nome_input.val() == "" || nome_input.val() == null)
             {

               $("#nome").addClass("has-error");
               ret=false;
             }
						 if(email_input.val() == "" || email_input.val() == null)
						 {

							 $("#email").addClass("has-error");
							 ret=false;
						 }
						 if(s_input.val()== "" || s_input.val() == null ){
							 $("#pwd").addClass("has-error");
							ret=false;
						 }
             return(ret);
           });
         });
     </script>
	</div>
	<div class='row' >
		Já possui conta?
		<a class='cpointer' href='/php/project/login.html'>Fazer Login</a>
	</div>
  </div>
</body>
</html>

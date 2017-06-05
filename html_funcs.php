<?php
function nav($aluno=TRUE){
  require "authenticate.php";
  require "links.php";
  $html_result='<div id="mySidenav" class="sidenav center col-sm-0">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';

  $html_result.='<div class="row"><img src="'.imagem($_SESSION['user']).'"
          class="col-sm-8 col-sm-offset-2 img-circle imgp" alt="Cinque Terre"></div>
              <a href="'.$path.'/index.php?act=curso">Home</a>
                <a href="#">Editar perfil</a>
                 <a href="#">Pesquisar</a>
                  <a href="'.$path.'/index.php?act=listas">Minhas listas</a>
                   <a href="#">Criar</a>';
  if($aluno)

  $html_result.='</div>';
  return $html_result;

/*    <a href="#">About</a>
    <a href="#">Services</a>
    <a href="#">Clients</a>
    <a href="#">Contact</a>
  </div>';*/
}


  function html_header($link,$nav=TRUE){

    require 'links.php';
    echo '<!DOCTYPE html>
    <html lang="pt">
    <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="'.$link.'">
      <link rel="stylesheet" type="text/css" href="'.$path.'/sidebar/nav.css">
      <script src="'.$path.'/sidebar/sidebar.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>
    <body>
      ';
      echo '
      <div class="jumbotron">
        <h1><span class="open"style="font-size:30px;cursor:pointer" "padding-right: 100%" onclick="openNav()">&#9776; </span>
        BRAIN DEBUGGER</h1>
      </div>';
      if($nav)echo nav();
  }
  function html_closing(){
    echo "</body>
    </html>";
  }



?>

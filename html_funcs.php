<?php
  function nav($aluno=TRUE){
    require "authenticate.php";
    require "links.php";
    $html_result='<div id="mySidenav" class="sidenav center col-sm-0">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>';

    $html_result.='<div class="row"><img src="'.imagem($_SESSION['user']).'"
            class="col-sm-8 col-sm-offset-2 img-circle imgp" height="150" width="150" alt="Foto de perfil"></div>
                <a href="'.$path.'/index.php?act=curso">Home</a>
                  <a href="'.$path.'/edita_perfil.php">Editar perfil</a>
                   <a href="'.$path."/pesquisar.php".'">Pesquisar</a>
                    <a href="'.$path.'/index.php?act=listas">Minhas listas</a>';
                     
                     if(!$_SESSION['tipo'])
                      $html_result.='<a href="#">Criar</a>';
                  $html_result.='<a href="'.$path."/logout.php".'">Sair</a>';
    if($aluno)

    $html_result.='</div>';
    return $html_result;
  }

  function html_header($link,$nav=TRUE){

    require 'links.php';
    echo '<!DOCTYPE html>
    <html lang="pt">
    <head>
      <title>Bootstrap Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/'.$link.'">
      <link rel="stylesheet" type="text/css" href="'.$path.'/sidebar/nav.css">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="'.$path.'/sidebar/sidebar.js"></script>

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

    function modal($nome, $botao, $titulo){
        echo '<button type="button" class="btn btn-default" data-toggle="modal" data-target="#'.$nome.'">'.$botao.'</button><br><br>

        <!-- Modal -->
<div id="'.$nome.'" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">'.$titulo.'</h4>
      </div>
      <div class="modal-body">';
  }

    function modal_footer($fechar){
      echo  '</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">'.$fechar.'</button>
      </div>
    </div>

  </div>
</div>';
    }

?>

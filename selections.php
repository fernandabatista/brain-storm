<?php

function tableCurso(){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";    // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn,"utf8");
  $sql = "SELECT c.* from usuario u JOIN
  usuario_has_Curso uc ON u.ID_Usuario = uc.ID_Usuario JOIN
  curso c ON c.ID_Curso = uc.ID_Curso WHERE uc.ID_Usuario = ".$user;
  $result = mysqli_query($conn, $sql);
  $html_result="";
  $_SESSION['cid']=0;
  ECHO "CURSO";
  $_SESSION["cloc"] = "curso";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link=$path."/disciplinas.php?id=";
    while($row = mysqli_fetch_assoc($result)) {

      if($cont==4){
        $html_result.="</div>";
        $cont=0;
      }
      if($cont==0){
        $html_result.="<div class='row'>";
      }
      $html_result.=' <div class="col-sm-3">
      <div class="panel panel-default hoverable">
      <a href='.$link.$row['ID_Curso'].'>
      <div class="panel-heading"><h1>'.$row['Tag'].'
      </h1><div class="panel-body">'.$row['Nome_Curso'].
      '</div>
      </div>
      </div>
      </a></div>';
      $cont++;

    }
  }
  else {
  }
  echo ($html_result."</div>");
  mysqli_close($conn);
}

function disciplinas($id){
  require "credentials.php";
  require "links.php";
  require "authenticate.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn,"utf8");
  $sql = "SELECT * FROM disciplina WHERE ID_Curso=$id";
  $result = mysqli_query($conn, $sql);
  $html_result="";
  $_SESSION['cid']=$id;
  $_SESSION["cloc"] = "disciplina";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link=$path."/assuntos.php?id=";
    while($row = mysqli_fetch_assoc($result)) {

      if($cont==4){
        $html_result.="</div>";
        $cont=0;
      }
      if($cont==0){
        $html_result.="<div class='row'>";
      }
      $html_result.=' <div class="col-sm-3">
      <div class="panel panel-default hoverable">
      <a href='.$link.$row['ID_Disciplina'].'>
      <div class="panel-heading"><h4>'.$row['Nome_Disciplina'].'
      </h4>
      </div>
      </div>
      </a></div>';
      $cont++;
    }

  }
  echo ($html_result."</div>");
  mysqli_close($conn);
}

function assuntos($id){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn,"utf8");
  $sql = "SELECT * FROM assunto WHERE ID_Disciplina=$id";
  $result = mysqli_query($conn, $sql);
  $html_result="";
  $_SESSION['cid']=$id;
  $_SESSION["cloc"] = "assunto";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link=$path."/exercicios.php?id=";
    while($row = mysqli_fetch_assoc($result)) {

      if($cont==4){
        $html_result.="</div>";
        $cont=0;
      }
      if($cont==0){
        $html_result.="<div class='row'>";
      }
      $html_result.=' <div class="col-sm-3">
      <div class="panel panel-default hoverable">
      <a href='.$link.$row['ID_Assunto'].'>
      <div class="panel-heading"><h4>'.$row['Nome_Assunto'].'
      </h4>
      <div class="panel-body"></div>
      <button><span class="glyphicon glyphicon-plus"></span></button>
      </div>
      </div>
      </a></div>';
      $cont++;
    }
    echo ($html_result."</div>");
  }

  mysqli_close($conn);
}

function exercicios($id,$form=FALSE){
  require'credentials.php';
  require "links.php";
  require "authenticate.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn,"utf8");
  $sql = "SELECT * FROM exercicio WHERE ID_Assunto=$id";
  $result = mysqli_query($conn, $sql);
  $html_result="";
<<<<<<< HEAD
=======
  $_SESSION['cid']=$id;
>>>>>>> c8b92bf6672c814a82ce888236a252467a741558
  $num_rows=mysqli_num_rows($result);
  if ($num_rows > 0) {
    // output data of each row
    $cont=0;
    $link=$path."/exercicios.php?id=";
    if($form)
<<<<<<< HEAD
      $html_result.='<form action="cria_lista.php" method="post">';
=======
      $html_result.='<form action="'.$path.'/cria_lista.php?id="'.$id.' method="post">';
>>>>>>> c8b92bf6672c814a82ce888236a252467a741558
    while($row = mysqli_fetch_assoc($result)) {

      $html_result.="  <div class='row'>
          <span class='col-sm-3'></span>
          <div class='panel panel-default col-sm-6'>";
      if($form)
        $html_result.='<input type="checkbox" name="check_list[]" value="'.$row['ID_Exercicio'].'" class="left">';

            $html_result.="<div class='panel-heading'>".$row['titulo']."</div>
            <div class='panel-body'>
            a)".$row['a1']."<br/>
            b)".$row['a2']."<br/>
            c)".$row['a3']."<br/>
            d)".$row['a4']."<br/>
            e)".$row['a5']."<br/>
          </div>
          </div>
        </div>";
        //if($form)
          // $html_result.="</label>";
    }
    echo $html_result."</div>";
    if($form){
      echo("<button type='submit' class='btn btn-default impbtn col-sm-4 col-sm-offset-4'>PRONTO</button>");
      echo("</form>");
    }
  }

  mysqli_close($conn);
}

function breadcumb($tag,$id){
  require 'credentials.php';
  require "links.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
    mysqli_set_charset($conn,"utf8");
  $array = array();
    while($tag>=0){
    switch($tag){
      case 2:
        $sql="select * from assunto where ID_Assunto = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id=$row['ID_Disciplina'];

        $array[]=array($row['Nome_Assunto'],$id);
        $tag--;

      break;
      case 1:
        $sql="select * from disciplina where ID_Disciplina = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id=$row['ID_Curso'];

        $array[]=array($row['Nome_Disciplina'],$id);
        $tag--;

      break;
      case 0:
          $sql="select * from curso where ID_Curso = $id";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

          $array[]=array($row['Nome_Curso'],$id);
          $tag--;
          break;
      break;

    }
  }
  $array=array_reverse($array);
  $html_result="<ul class='breadcrumb center'><li><a href='$path./cursos.php' class='bclink'>HOME</a></li>";
  for($i=0;$i<count($array);$i++){
    if($i==count($array)-1){
      $html_result.="<li>".$array[$i][0]."</li>";
      continue;
    }

    $link=$path;
    switch($i){
    case 0:
    $link.="/disciplinas.php";
    break;
    case 1:

    $link.="/assuntos.php";
    break;
    case 2:

    $link.="/exercicios.php";
    break;
    }
    $link.="?id=".$array[$i+1][1];
    $html_result.="<li><a href='$link' class='bclink'>".$array[$i][0]."</a></li>";
  }
  echo ($html_result."</ul>");
  mysqli_close($conn);
  }

  function professores(){
    require 'credentials.php';
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM usuario WHERE Aluno=false";
    $result = mysqli_query($conn, $sql);
    $html_result="<div class='list-group'>";
    if (mysqli_num_rows($result) > 0) {
      // output data of each row
      $cont=0;
      $link="#";
      while($row = mysqli_fetch_assoc($result)) {
        $html_result.= "<a href='$link' class='list-group-item'><span class='lprof'>".
                                      $row['Nome_Usuario']. "</span> <span class=' icon glyphicon glyphicon-eye-open'></span></a>";
      }
      echo ($html_result."</div>");
    }

    mysqli_close($conn);
  }

function login($_email,$_pw){
    require "authenticate.php";
    require'credentials.php';
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["pwd"]);
    // $password = md5($password);
    $sql = "SELECT ID_Usuario,Senha, Email, Nome_Usuario,Aluno FROM usuario
            WHERE email = '$email'";

    $result = mysqli_query($conn, $sql);
    if($result){
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if ($user["Senha"] == $password) {
          $_SESSION["user"] = $user["ID_Usuario"];
          $_SESSION["name"] = $user["Nome_Usuario"];
          $_SESSION["tipo"] = $user["Aluno"];
          $_SESSION["cid"] = 0;
          $_SESSION["cloc"] = "curso";
          header("Location: " . $path . "/cursos.php");
          exit();
        }else {
          echo 'dados incorretos';
        }
      }
    }
}

function imagem($id){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn,"utf8");
  $sql = "SELECT Imagem from Usuario Where ID_Usuario = $id";

  $result = mysqli_query($conn, $sql);
  $html_result="";
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    return ($row['Imagem']);
  }
}
?>

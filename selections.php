<?php

function select($table,$id=0){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";

  $tables = array('curso' => "Curso",'disciplina'=>"Disciplina",
      'assunto'=>"Assunto",'exercicio'=>"Exercicio");

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  mysqli_set_charset($conn,"utf8");

  $at="ID_".$table;
  $header=4;
  $keys=array_keys($tables);
  $pos=array_search($table,$keys);

  $atnome="Nome_".$tables[$table];


  if($table=="curso"){
    $header=1;
    $sql = "SELECT c.* from usuario u JOIN
    usuario_has_Curso uc ON u.ID_Usuario = uc.ID_Usuario JOIN
    curso c ON c.ID_Curso = uc.ID_Curso WHERE uc.ID_Usuario = ".$_SESSION['user'];
  }else{
    $at="ID_".$tables[$keys[$pos-1]];
    $sql = "SELECT * FROM $table where $at=$id" ;
  }
  $result = mysqli_query($conn, $sql);
  $html_result="";


  if (mysqli_num_rows($result) > 0) {
    $tagn="";
    $smname="";
    $cont=0;
    $idc;
    $atid="ID_".$tables[$table];
    while($row = mysqli_fetch_assoc($result)) {
      if(isset($row['Tag'])){
        $tagn=$row['Tag'];
        $smname=$row[$atnome];
      }else{
        $tagn=$row[$atnome];
      }

      $link=$path."/index.php?act=".$keys[$pos+1]."&id=".$row[$atid];

      if($cont==4){
        $html_result.="</div>";
        $cont=0;
      }
      if($cont==0){
        $html_result.="<div class='row'>";
      }
      $html_result.=' <div class="col-sm-3">
      <div class="panel panel-default hoverable">
      <a href='.$link.'>
      <div class="panel-heading"><h'.$header.'>'.$tagn.'
      </h'.$header.'><div class="panel-body">'.$smname.
      '</div>
      </div>
      </div>
      </a></div>';
      $cont++;
    }
  }
  else {
  }
  return ($html_result."</div>");
  mysqli_close($conn);

}

function pesquisa($table,$text){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";    // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn,"utf8");

  $at="ID_".$table;
  $atnome="Nome_".$table;

  $sql = "SELECT ID_Curso FROM usuario_has_Curso where ID_Usuario=".$_SESSION['user'] ;
  $result = mysqli_query($conn, $sql);
  $cursos=array();
  while($row = mysqli_fetch_assoc($result)) {
    $cursos[]=$row['ID_Curso'];
  }

  $sql = "SELECT * FROM $table where $atnome like '%$text%'" ;
  $result = mysqli_query($conn, $sql);
  $html_result="";


  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $idc;


    $html_result.="<h3 class='center'>RESULTADOS DA PESQUISA POR ".strtoupper($table). ":</h3><br/>";

    while($row = mysqli_fetch_assoc($result)) {
      $dis="";
      $tag="";
      if(!isset($row['Tag'])){

        if(!isset($row['ID_Curso'])){
          $sql2="SELECT ID_Curso from Disciplina
            where ID_Disciplina=".$row['ID_Disciplina'];
            $result2 = mysqli_query($conn, $sql2);
            $row2=mysqli_fetch_assoc($result2);
            $idc=$row2['ID_Curso'];
        }else{
          //echo "aaa";
          $idc=$row['ID_Curso'];

        }
        $sql2="SELECT Tag from Curso
          where ID_Curso=".$idc;
          $result2 = mysqli_query($conn, $sql2);
          $row2=mysqli_fetch_assoc($result2);
          $tag=$row2['Tag'];
        }
        else {
         $idc=$row['ID_Curso'];
       }

      $link=$path."/index.php?act=scurso&id=".$idc;
      if(in_array($idc,$cursos)){
        $dis="disabled";
        $link="#";
      }

      if($cont==4){
        $html_result.="</div>";
        $cont=0;
      }
      if($cont==0){
        $html_result.="<div class='row'>";
      }
      $html_result.=' <div class="col-sm-3 col-md-3">
      <div class="panel panel-default">

      <div class="panel-heading"><h6>'.$tag.
      '</h6><h4>'.$row[$atnome].'
      </h4><div class="panel-body">
      <a href="'.$link.'" class="'.$dis.'"><button class="btn btn-default '.$dis.'">
      <span class="glyphicon glyphicon-floppy-disk"></span> SALVAR CURSO</button></a></div>
      </div>
      </div>
      </div>';
      $cont++;


    }
  }
  else {
  }
  return ($html_result."</div>");
  mysqli_close($conn);
}

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
  $_SESSION["cloc"] = "curso";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link=$path."/index.php?act=disciplina&id=";
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
  $link=$path."/create_disciplina.php";
  // $html_result.='
  // <br><br>';
  // $html_result.='<div class="col-sm-3">
  //     <div class="panel panel-default hoverable">
  //       <a href='.$link.'>
  //       <div class="panel-heading">
  //         <h4>NOVA DISCIPLINA</h4>
  //       </div>
  //       </a>
  //     </div>
  //     </div>';
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link=$path."/index.php?act=assunto&id=";
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
      $html_result.='
      <div class="col-sm-3">
        <div class="panel panel-default hoverable">
          <a href='.$link.$row['ID_Assunto'].'>
            <div class="panel-heading"><h4>'.$row['Nome_Assunto'].'
              </h4>
            <div class="panel-body"></div>
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
  $_SESSION['cid']=$id;
  $num_rows=mysqli_num_rows($result);
  if ($num_rows > 0) {
    // output data of each row
    $cont=0;
    $link=$path."/exercicios.php?id=";
    if($form){
      $html_result.='<form id="form-test" action="lista.php" method="post">
      <div class="form-group col-sm-6 col-sm-offset-3" id="nome">
        <label for="name">Nome da lista:</label>
    		<input name="name" type="text"  class="form-control center" >
    	</div>';
    }

    while($row = mysqli_fetch_assoc($result)) {

      $html_result.="  <div class='row'>
        <div class='panel panel-default col-sm-6 col-sm-offset-3'>";
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

function exerciciosLista($id,$do=false){
  require'credentials.php';
  require "links.php";
  require "authenticate.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $html_result="";
  mysqli_set_charset($conn,"utf8");
  $sql = "select e.* from exercicio e JOIN
  lista_has_exercicio le ON e.ID_Exercicio = le.ID_Exercicio JOIN
  lista l ON l.ID_Lista = le.ID_Lista where le.ID_Lista=$id;";
  if($do){
    $html_result.="<form action='fazerlista.php' method='post'>";
  }
  $_SESSION['cid']=$id;
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)) {
    $html_result.="  <div class='row'>
      <div class='panel panel-default col-sm-6 col-sm-offset-3'>";
      $html_result.="<div class='panel-heading'>".$row['titulo'];

      if($do){
          $html_result.='<select name="selected[]">
              <option value="1">A</option>
              <option value="2">B</option>
              <option value="3">C</option>
              <option value="4">D</option>
              <option value="5">E</option>
            </select>';
      }

      $html_result.="</div>
      <div class='panel-body'>
      a)".$row['a1']."<br/>
      b)".$row['a2']."<br/>
      c)".$row['a3']."<br/>
      d)".$row['a4']."<br/>
      e)".$row['a5']."<br/>
      </div>
      </div>
      </div>";
  }

  echo $html_result."</div>";
  if($do){
    echo("<button type='submit' class='btn btn-default impbtn col-sm-4 col-sm-offset-4'>PRONTO</button>");
    echo("</form>");

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
      case 3:
        $sql="select * from lista where ID_Lista = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $id=$row['ID_Assunto'];
        $array[]=array('LISTAS',$id);
        $tag--;

      break;
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
  $html_result="<ul class='breadcrumb center'><li><a href='$path/index.php?act=curso' class='bclink'>HOME</a></li>";
  for($i=0;$i<count($array);$i++){
    if($i==count($array)-1){
      $html_result.="<li>".$array[$i][0]."</li>";
      continue;
    }

    $link=$path;
    switch($i){
    case 0:
    $link.="/index.php?act=disciplina&";
    break;
    case 1:

    $link.="/index.php?act=assunto&";
    break;
    case 2:

    $link.="/exercicios.php?";
    break;
    }
    $link.="id=".$array[$i+1][1];
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
          header("Location: " . $path . "/index.php?act=curso");
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

function calls($act,$id,$bc=false){

  switch ($act) {

    case 'curso':
      return select($act);
      break;
    case 'disciplina':

      return $bc?breadcumb(0,$id):select($act,$id);
      break;
     case 'assunto':
      return $bc?breadcumb(1,$id):assuntos($id);
      break;
     case 'listas':

     if($id===0){

       return listas(0,true);
     }
      return $bc?breadcumb(3,$id):listas($id);
      break;
    default:
      echo "";
      break;
  }
}

function listas($id,$minhas=false){
  require'credentials.php';
  require "links.php";
  require "authenticate.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  mysqli_set_charset($conn,"utf8");
  $sql="";

  if($minhas){
    $sql .= "select l.* from lista l JOIN
          usuario_has_lista ul ON l.ID_Lista= ul.ID_Lista JOIN
          usuario u ON u.ID_Usuario = ul.ID_Usuario where
          ul.ID_Usuario=".$_SESSION['user'];
  }else{
    $sql .= "SELECT * FROM lista WHERE ID_Assunto=$id";
    $_SESSION['cid']=$id;
  }
  $result = mysqli_query($conn, $sql);
  $html_result="";

  $num_rows=mysqli_num_rows($result);
  if ($num_rows > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {

      $html_result.="
        <div class='row'>
          <div class='panel panel-default col-sm-6 col-sm-offset-3'>
            <div class='panel-heading'>".$row['Nome_Lista'].
              "<div class='row'>";

                $buttons=$links=array();


                if($_SESSION['tipo']){
                    $buttons['pencil']="FAZER";
                    $links[]=$path."/fazerlista.php?id=".$row['ID_Lista'];
                }else if($minhas){
                    $buttons['registration-mark']="RELATÓRIO";
                    $links[]=$path."/relatoriolista.php?id=".$row['ID_Lista'];
                }

                // $buttons['eye-open']="VER";
                // $links[]=$path."/verlista.php?id=".$row['ID_Lista'];

                if(!$minhas){
                  $buttons['floppy-disk']="SALVAR";
                  $links[]="#";
                }else{
                  $buttons['trash']="EXCLUIR";
                  $links[]="#";
                }

                $n=0;
                $offset=6-count($buttons)*2;

                foreach ($buttons as $key => $value) {
                  $html_result.="<a href='".$links[$n]."'>
                  <button type='button' class='btn btn-default col-sm-4 col-sm-offset-$offset'>
                  <span class='glyphicon glyphicon-".$key." fleft'>
                  </span>".$value."</button></a>";

                  $n++;
                  $offset=0;
                }

                /*$html_result.="<a href='".$path."/fazerlista.php?id=".$row['ID_Lista']."'>
                <button type='button' class='btn btn-default col-sm-4 col-sm-offset-4'>
                <span class='glyphicon glyphicon-pencil fleft'>
                </span>FAZER</button></a>";*/

            $html_result.="</div>
            </div>
          </div>
        </div>";
    }
    echo $html_result;
  }

  mysqli_close($conn);
}

function comparar($id,$respostas){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";
  require_once "insertions.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $html_result="";
  $corretas = $erradas = "";
  $c=0;
  mysqli_set_charset($conn,"utf8");
  $sql = "select correta from exercicio e JOIN
  lista_has_exercicio le ON e.ID_Exercicio = le.ID_Exercicio JOIN
  lista l ON l.ID_Lista = le.ID_Lista where le.ID_Lista=$id;";
  $result = mysqli_query($conn, $sql);
  $num_rows= mysqli_num_rows($result);
  // echo "aaaa";
  $i=0;
  while($row = mysqli_fetch_assoc($result)) {

      if($row["correta"]==$respostas[$i]){
        $corretas.=($i+1)." ";
        $c++;

      }else{
        $erradas.=($i+1)." ";
      }
      $i++;
  }
  escore($id,$c);
  $html_result.="<h2>VOCÊ ACERTOU $c DE $num_rows!</h2><br/>";
  return $html_result."<h4>CORRETA(S):</h4>$corretas
  <h4>ERRADA(S):</h4>$erradas";


}

function relatorio($id){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";
  require_once "insertions.php";
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $html_result='<table class="table table-condensed col-sm-6 ">
    <thead>
      <tr>
        <th>Aluno</th>
        <th>Data</th>
        <th>Escore</th>
      </tr>
    </thead>
    <tbody>';
  $c=0;
  mysqli_set_charset($conn,"utf8");
  $sql = "select u.Nome_Usuario, ul.Escore, ul.Data_ from lista l JOIN
        usuario_faz_lista ul ON l.ID_Lista= ul.ID_Lista JOIN
        usuario u ON u.ID_Usuario = ul.ID_Usuario where ul.ID_Lista=$id";
  $result = mysqli_query($conn, $sql);
  $num_rows= mysqli_num_rows($result);
  // echo "aaaa";
  $i=0;
  while($row = mysqli_fetch_assoc($result)) {
      $html_result.="<tr class='uncenter'><td>".$row['Nome_Usuario'].
                    "</td><td>".$row['Data_'].
                    "</td><td>".$row['Escore'].
                    "</td></tr>";
  }
  $html_result.="</tbody></table>";
  echo $html_result;
  mysqli_close($conn);
}
?>

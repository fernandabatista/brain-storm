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

    if($table=="assunto"&&$_SESSION['tipo']){
        $link="index.php?act=listas&id=".$row[$atid];
      }else{
        $link="index.php?act=".$keys[$pos+1]."&id=".$row[$atid];
    }
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
  mysqli_close($conn);
  return ($html_result."</div>");


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

function hier($act,$id=0){
  require 'credentials.php';
  require "links.php";
  require "authenticate.php";

  $bc=array();

  if($act=="curso")
    return $bc;

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  mysqli_set_charset($conn,"utf8");

  if($act=="listas"){
    if(!$_SESSION['tipo']){
      $bc[]=array(0,"LISTAS");
    }
    $act="exercicio";
  }

  if($act=="exercicio"){
    $sql = "SELECT Nome_Assunto,ID_Disciplina FROM assunto where ID_Assunto=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $bc[]=array($id,$row['Nome_Assunto']);
    $act="assunto";
    $id=$row['ID_Disciplina'];
  }

  if($act=="assunto"){
    $sql = "SELECT ID_Curso,Nome_Disciplina
      FROM DISCIPLINA where ID_Disciplina=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $bc[]=array($id,$row['Nome_Disciplina']);
    $id=$row['ID_Curso'];
    $act="disciplina";
  }

  if($act=="disciplina"){
    $sql = "SELECT Nome_Curso FROM CURSO where ID_Curso=$id";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $bc[]=array($id,$row['Nome_Curso']);
    $act="curso";
  }

  if($act=="curso"){
    $bc[]=array("","HOME");
  }

  mysqli_close($conn);
  return array_reverse($bc);

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
      $html_result.="
      <span class='btns' id=s".$row['ID_Exercicio'].">
      <a href='javascript:;' class='vote_up green' id='".$row['ID_Exercicio']."'>
      <span class='glyphicon glyphicon-thumbs-up'></span>
      </a><span id='pos'>".$row['Positivos']."</span>
      <a href='javascript:;' class='vote_down red' id='".$row['ID_Exercicio']."'>
      <span class='glyphicon glyphicon-thumbs-down'></span>
      </a><span id='neg'>".$row['Negativos']."</span>
      </span>";
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
    $html_result.="</div>";
    if($form){
      $html_result.="<button type='submit' class='btn btn-default impbtn col-sm-4 col-sm-offset-4'>PRONTO</button>";
      $html_result.="</form>";
    }
  }
  return $html_result;
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

  $html_result.="</div>";
  if($do){
    $html_result.="<button type='submit' class='btn btn-default impbtn col-sm-4 col-sm-offset-4'>PRONTO</button>";
    $html_result.="</form>";
  }
  mysqli_close($conn);
  return $html_result;
}

function breadcrumb($act="",$id=0,$special=""){
  $html_result="<ul class='breadcrumb center'>";

  if($special){
    $html_result.="<li><a class='bclink' href='index.php?act=curso'>HOME</a></li>";
    $html_result.="<li>$special</li>";
    return $html_result."</ul>";
  }

  $array = hier($act,$id);
  if(!empty($array)){
    $order=array("curso","disciplina","assunto","exercicio");
    for($i=0;$i<count($array)-1;$i++){
        $html_result.="<li><a class='bclink' href='index.php?act=".$order[$i];
        if(isset($array[$i][0])){
          $html_result.="&id=".$array[$i][0];
        }
        $html_result.="'>".$array[$i][1]."</a></li>";
    }
    $html_result.="<li>".$array[$i][1]."</li>";

    return $html_result."</ul>";
  }
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

      while($row = mysqli_fetch_assoc($result)) {
        $link="adm_showprof.php?id=".$row['ID_Usuario'];
        $html_result.= "<a href='$link' class='list-group-item'><span class='lprof'>".
                                      $row['Nome_Usuario']. "</span> <span class=' icon glyphicon glyphicon-eye-open'></span></a>";
      }
      echo ($html_result."</div>");
    }

    mysqli_close($conn);
  }

function login($_email,$_pw,$adm=0){
    require "authenticate.php";
    require'credentials.php';
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $email = mysqli_real_escape_string($conn,$_POST["email"]);
    $password = mysqli_real_escape_string($conn,$_POST["pwd"]);
    // $password = md5($password);

    if($adm){
      $sql = "SELECT ID_Admin,Senha_Admin, Email_Admin FROM admin
              WHERE Email_Admin = '$email'";
    }else{
    $sql = "SELECT ID_Usuario,Senha, Email, Nome_Usuario,Aluno FROM usuario
            WHERE email = '$email'";
    }
    $result = mysqli_query($conn, $sql);
    if($result){
      if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if($adm)
          $senha=$user["Senha_Admin"];
        else
          $senha=$user["Senha"];
        if ($senha == $password) {
          if($adm){
              $_SESSION["user"] = $user["ID_Admin"];
              $_SESSION["name"] = "";
              $_SESSION["tipo"] = false;
              header("Location: " . $path . "/adm_listap.php");
              exit();
          }else{
            $_SESSION["user"] = $user["ID_Usuario"];
            $_SESSION["name"] = $user["Nome_Usuario"];
            $_SESSION["tipo"] = $user["Aluno"];
            $_SESSION["cid"] = 0;
            $_SESSION["cloc"] = "curso";
            header("Location: " . $path . "/index.php?act=curso");
            exit();
          }

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

      return select($act,$id);
      break;
    case 'assunto':
      return select($act,$id);
      break;

    case 'listas':

     if($id===0){

       return listas(0,true);
     }
      return $bc?breadcumb(3,$id):listas($id);
      break;

    case 'exercicio':
      $html_result="
          <div class='row'>
            <a href='index.php?act=listas&id=".$id."'>
            <button type='button' class='btn btn-default col-sm-6 col-sm-offset-3'>
            <span class='glyphicon glyphicon-eye-open fleft'>
            </span>VER LISTAS</button></a>
          </div>

        <div class='row'>
          <a href='lista.php?id=".$id."'><button type='button' class='btn btn-default col-sm-6 col-sm-offset-3'>
            <span class='glyphicon glyphicon-plus fleft'>
            </span>NOVA LISTA</button></a>
        </div>

        <div class='row'>
          <a href='create_exercicios.php?id=$id'>
          <button type='button' class='btn btn-default col-sm-6 col-sm-offset-3'>
          <span class='glyphicon glyphicon-plus fleft'>
          </span>NOVO EXERCÍCIO</button></a>
        </div>
        <br/>";

        echo $html_result.exercicios($id);
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

                $buttons['eye-open']="VER";
                $links[]=$path."/verlista.php?id=".$row['ID_Lista'];

                if(!$minhas){
                  $buttons['floppy-disk']="SALVAR";
                  $links[]="index.php?act=slistas&id=".$row['ID_Lista'];
                }else{
                  $buttons['trash']="EXCLUIR";
                  $links[]="index.php?act=dlistas&id=".$row['ID_Lista'];
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

<?php


function tableCurso(){
  require_once 'credentials.php';    // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM curso";
  $result = mysqli_query($conn, $sql);
  $html_result="";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link="/php/project/disciplinas.php?id=";
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
      <div class="panel-heading"><h1>'.$row['tag'].'
      </h1><div class="panel-body">'.$row['Nome_curso'].
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
  require_once 'credentials.php';
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM disciplina WHERE ID_Curso=$id";
  $result = mysqli_query($conn, $sql);
  $html_result="";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link="/php/project/assuntos.php?id=";
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
      <div class="panel-heading"><h4>'.$row['Nome_disciplina'].'
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
  require_once 'credentials.php';
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM assunto WHERE ID_Disciplina=$id";
  $result = mysqli_query($conn, $sql);
  $html_result="";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link="/php/project/exercicios.php?id=";
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
      <a href='.$link.$row['ID_assunto'].'>
      <div class="panel-heading"><h4>'.$row['Nome_assunto'].'
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

function exercicios($id){
  require_once 'credentials.php';
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM exercicio WHERE ID_Assunto=$id";
  $result = mysqli_query($conn, $sql);
  $html_result="";
  if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $cont=0;
    $link="/php/project/exercicios.php?id=";
    while($row = mysqli_fetch_assoc($result)) {

      $html_result.="  <div class='row'>
          <span class='col-sm-3'></span>
          <div class='panel panel-default col-sm-6'>
            <div class='panel-heading'>".$row['titulo']."</div>
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
    echo ($html_result."</div>");
  }

  mysqli_close($conn);
}
?>

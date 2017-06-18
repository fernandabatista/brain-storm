<?php
  function cria_lista($ass,$check_list,$name){
     require "credentials.php";
     require "authenticate.php";
     require "links.php";
     $conn = mysqli_connect($servername, $username, $password, $dbname);
     // Check connection
     if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
     }
     $sql = "INSERT INTO lista VALUES (null,'$name',$ass)";
     mysqli_query($conn, $sql);
     $lid=mysqli_insert_id($conn); //suspeito
     $sql="INSERT INTO usuario_has_lista VALUES ($user,$lid)";
     mysqli_query($conn, $sql);
     $sql="";
     foreach($check_list as $selected) {
        $sql.="INSERT INTO lista_has_exercicio VALUES ($selected,$lid);";
     }

     mysqli_multi_query($conn, $sql);
     mysqli_close($conn);

     header("Location: " . $path . "/verlista.php?id=".$lid);
     exit();

  }

  function cria_exercicio($ass,$enunc,$a,$correta){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($conn,'utf8');
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO exercicio VALUES (null,'$enunc','$a[0]','$a[1]','$a[2]','$a[3]','$a[4]',$correta,0,0,$ass)";
    mysqli_query($conn, $sql);
    echo $sql;

    // $lid=mysqli_insert_id($conn); //suspeito

    header("Location: index.php?act=exercicio&id=".$ass);
    exit();

  }

  function escore($id,$c){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "select now()";
    $result = mysqli_query($conn, $sql);
    $now = mysqli_fetch_assoc($result);
    $now = $now['now()'];
    $sql = "INSERT INTO usuario_faz_lista VALUES (null,'".$_SESSION['user']."',$id,'$now',$c)";
    mysqli_query($conn, $sql);

    mysqli_close($conn);

    //header("Location: " . $path . "/verlista.php?id=".$lid);
    //exit();
  }

  function cria_disciplina($ass,$nome){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO disciplina VALUES (null,'$nome')";
    mysqli_query($conn, $sql);
  }

  function salva_curso($id){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO usuario_has_Curso VALUES
      (".$_SESSION['user'].",$id)";
    mysqli_query($conn, $sql);
    //echo $sql;
    mysqli_close($conn);
  }

  function novo($act,$tagid,$nome){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    mysqli_set_charset($conn,"utf8");
    $sql = "INSERT INTO $act VALUES (null,'$nome','$tagid')";
    mysqli_query($conn, $sql);



    $headeraux="";
    if($act=="curso"){
      echo "aa:".mysqli_insert_id($conn);

      salva_curso(mysqli_insert_id($conn));
    }else{
      $headeraux="&id=".$tagid;
    }
    mysqli_close($conn);
    header("Location: " . $_SERVER['PHP_SELF']."?act=".$act.$headeraux);
    exit();
  }

?>

<?php
  function usuario_has_lista($id){
    require'credentials.php';
    require "links.php";
    require "authenticate.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql="DELETE FROM usuario_has_lista WHERE ID_Usuario=".$_SESSION['user'].
      " AND ID_Lista=".$id;

    mysqli_query($conn,$sql);
    mysqli_close($conn);
    //echo $sql;
  }

  function deletaprof($id){
    require "credentials.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql="DELETE FROM Usuario WHERE ID_Usuario=$id";

    mysqli_query($conn,$sql);
    mysqli_close($conn);
  }

 ?>

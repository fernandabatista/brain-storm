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
?>

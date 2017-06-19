<?php



    require_once 'credentials.php';
    require "selections.php";  // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO usuario(nome_usuario,senha,email,aluno) VALUES ('".$_POST['name']."','"
                        .$_POST['pwd']."','".$_POST['email']."',true);";
    mysqli_query($conn, $sql);
     //suspeito

    mysqli_query($conn, $sql);
    mysqli_close($conn);
    login($_POST['email'],$_POST['pwd']);
    header("Location: index.php?act=curso");

 ?>

<?php



    require_once 'credentials.php';    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO usuario(nome_usuario,senha,email) VALUES ('".$_POST['name']."','"
                        .$_POST['pwd']."','".$_POST['email']."');";
    mysqli_query($conn, $sql);
    $lid=mysqli_insert_id($conn); //suspeito
    $sql = "INSERT INTO aluno values(".$lid.");";
    echo $sql;
    mysqli_query($conn, $sql);
    mysqli_close($conn);

 ?>

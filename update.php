<?php function perfil($ass, $nome, $pwd){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $id = mysqli_insert_id($conn);
    $sql = "UPDATE usuario SET Nome_Usuario='$nome', Senha='$pwd' WHERE ID_Usuario = '".$_SESSION['user']."'";
    //mysqli_query($conn, $sql);
    //echo $sql;
        //foto
    // if (isset($_FILES['imagem'])) {
    //     $extensao = strtolower(substr($_FILES['arquivo']['name'] , -4));
    //     $novo_nome = md5(time()). $extensao;
    //     $diretorio = "/sistema-web/img/";


    //     move_uploaded_file($_FILES['arquivo']['tmp-name'], $diretorio.$novo_nome);

    // $sql = "INSERT INTO user (Imagem) VALUES ('&imagem')";
    if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
}
?>
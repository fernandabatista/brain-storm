<?php function perfil($ass, $nome, $email, $pwd){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "UPDATE usuario set Nome_Usuario='$nome' where id = $ass";
    mysqli_query($conn, $sql);
    echo $sql;
        //foto
    // if (isset($_FILES['imagem'])) {
    //     $extensao = strtolower(substr($_FILES['arquivo']['name'] , -4));
    //     $novo_nome = md5(time()). $extensao;
    //     $diretorio = "/sistema-web/img/";


    //     move_uploaded_file($_FILES['arquivo']['tmp-name'], $diretorio.$novo_nome);

    // $sql = "INSERT INTO user (Imagem) VALUES ('&imagem')";
}
?>
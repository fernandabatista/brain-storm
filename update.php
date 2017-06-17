<?php function perfil($ass, $nome, $pwd, $img){
    require "credentials.php";
    require "authenticate.php";
    require "links.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $id = mysqli_insert_id($conn);
    
    //mysqli_query($conn, $sql);
    //echo $sql;
        //foto
    if (isset($_FILES['arquivo'])) {
        $extensao = strtolower(substr($_FILES['arquivo']['name'] , -4));
        $novo_nome = md5(time()). $extensao;
        $diretorio = "img/";
        

        move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
        $img = $diretorio.$novo_nome;

    //$sql = "UPDATE usuario S(Imagem) VALUES ('&img')";
    $sql = "UPDATE usuario SET Nome_Usuario='$nome', Senha='$pwd', Imagem='$img' WHERE ID_Usuario = '".$_SESSION['user']."'";

    if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}
mysqli_close($conn);
}
?>
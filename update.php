<?php
    function perfil($ass, $nome){
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

        $sql = "UPDATE usuario SET Nome_Usuario='$nome' WHERE ID_Usuario = '".$_SESSION['user']."'";
        $_POST['nome'] = $nome;

        if (mysqli_query($conn, $sql)) {
        echo "Alterações Salvas! ";
    } else {
        echo "Error updating record: " . mysqli_error($conn);

    mysqli_close($conn);
    }
    }

    function mudafoto($ass, $img){
        require "credentials.php";
        require "authenticate.php";
        require "links.php";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
         //foto
        
        if (isset($_FILES['arquivo'])) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'] , -4));
            $novo_nome =$_SESSION['user']. $extensao;
            $diretorio = "img/";
            

            move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
            $img = $diretorio.$novo_nome;
            $sql = "UPDATE usuario SET Imagem='$img' WHERE ID_Usuario = '".$_SESSION['user']."'";

            if (!mysqli_query($conn, $sql)) {
                echo "Erro Atualizando Imagem: " . mysqli_error($conn);
            }
        }
    
    }
    function mudasenha($ass, $pwd){
        require "credentials.php";
        require "authenticate.php";
        require "links.php";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        } 
        $sql = "UPDATE usuario SET Senha='$pwd' WHERE ID_Usuario = '".$_SESSION['user']."'";
        if (mysqli_query($conn, $sql)) {
        echo "Alterações Salvas! ";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
    mysqli_close($conn);
    
    }
?>
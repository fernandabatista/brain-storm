<<<<<<< HEAD
<?php
  require "authenticate.php";
  if(!$login){
    header("Location: home.php");
    exit();
  }
=======

<?php
  	require "authenticate.php";
  	require "links.php";
  	
  if(!$login){
    header("Location: " . $path . "/login.php");
    
    //die("Você não tem permissão para acessar essas página.");
  }

>>>>>>> 6411fac3b1224d4a54e238861531fb92d8d25632
?>

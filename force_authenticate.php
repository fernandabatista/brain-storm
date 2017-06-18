
<?php
  	require "authenticate.php";
  	require "links.php";
  	
  if(!$login){
    header("Location: " . $path . "/login.php");
    
    //die("Você não tem permissão para acessar essas página.");
  }

?>

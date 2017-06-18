<?php

  require "credentials.php";
  require "authenticate.php";



  $conn = mysqli_connect($servername, $username, $password, $dbname);

  $id = $_POST['id'];
  $action = $_POST['action'];

  if($action=='vote_up') //voting up
  {

   $sql = "UPDATE exercicio SET Positivos = Positivos+1 WHERE ID_Exercicio=".$id;
  }
  else if($action=='vote_down') //voting down
  {

   $sql = "UPDATE exercicio SET Negativos = Negativos+1 WHERE ID_Exercicio=".$id;
  }

  mysqli_query($conn,$sql);
  $sql = "SELECT Positivos,Negativos FROM exercicio WHERE ID_Exercicio=".$id;
  $result=mysqli_query($conn,$sql);
  $row=mysqli_fetch_assoc($result);
  echo $row['Positivos']."/".$row['Negativos'];
  mysqli_close($conn);
 ?>

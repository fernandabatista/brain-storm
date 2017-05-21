<?php
  require_once "selections.php";
 ?>


<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style2.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>

  <div class='jumbotron'>
    <h1 >BRAIN DEBUGGER</h1>
  </div>
<div class='container' id='pageContent'>
  <?= exercicios($_GET['id']); ?>

</div>
</body>
</html>

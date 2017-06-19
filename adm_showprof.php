<?php
  require "selections.php";
  require "html_funcs.php";
  html_header("style.css");

  $array=array();
  if(isset($_GET['id'])){
    $array=prof($_GET['id']);
  }
?>
<div class='container' id='pageContent'>

<div class='row'>
		<span class='col-sm-3'></span>
		<div class="col-sm-6">
  			<h4 class="center"><?= $array['Nome_Usuario'] ?></h4>
  			 <div class="row">
    			<spam class="col-sm-4"></spam>
    			<div class="col-sm-4"> <img src='<?=$array['Imagem']?>' class="img-thumbnail" alt="Foto de perfil" width="300" height="300"></div>
    		 </div>

    		 <br><p class="center"><?= $array['Email'] ?></p>
			 <div class="row">
    		 
    		 	<a href="adm_listap.php"><button class="btn btn-default">VOLTAR</button></a>
    		  <a href="adm_listap.php?act=excluir&id=<?=$array['ID_Usuario']?>">	<button class="btn btn-default">EXCLUIR</button></a>

			 </div>
		</div>
  	</div>

</div>
<?php echo html_closing();?>

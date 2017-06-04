<?php
  require "selections.php";
  require "html_funcs.php";
  html_header("style.css");
  nav();
?>
<div class='container' id='pageContent'>

<div class='row'>
		<span class='col-sm-3'></span>
		<div class="col-sm-6">
  			<h4 class="center"><?php echo 'Nome_Usuario'; ?></h4>
  			 <div class="row">
    			<spam class="col-sm-4"></spam>
    			<div class="col-sm-4"> <img src="imagens/profx.jpg" class="img-thumbnail" alt="Cinque Terre" width="304" height="236"></div>
    		 </div>
			 
    		 <br><p class="center"><?php echo 'Email_Usuario' ?></p>
			 <div class="row">
    		 <form>
    		 	
    		 	<button type="submit" class="btn btn-default"><a href="#">VOLTAR</a></button>
    		 	<button type="submit" class="btn btn-default"><a href="#">EXCLUIR</a></button>
    		 </form>
			 </div>
		</div>
  	</div>

</div>
<?php echo html_closing();?>

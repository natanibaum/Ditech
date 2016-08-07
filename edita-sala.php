<?php
require_once('includes/config.php');
require_once('classes/sala.php');
$sala= new SALA();
$id = $_POST['id'];
//método popula sala para edições
$row = $sala->Sala($id);	

//Processo de update
if(isset($_POST['btn-edita'])){
	$nome = $_POST['nome'];
	$numero = $_POST['numero'];
	$id = $_POST['id'];
	//Instancia o método da classe de atualizacao de sala
	if( $sala->AtualizaSala($nome,$numero,$id)){ 
		header('Location: perfil.php?action=upFeitoSala');
		exit;
	
	}

}


$title = 'Ditech | Edição Sala';

//inclui cabeçalho
require('layout/header.php'); 
?>

	
<div class="container">

	<div class="row">

	   <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
	   <br>
         <h4>Edição de Sala</h4>
			<form  role="form" method="post" action="" name="cadastro" autocomplete="off" onSubmit="return validaSala();">
				<hr>
				<input name='id' type='hidden' value="<?php echo $row['id'];?>">
				<div class="form-group">
					<input type="text" name="nome" id="nome"  value="<?php echo $row['nome']; ?>"class="form-control input-lg" placeholder="Nome da Sala" tabindex="1" required>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="number" name="numero" value="<?php echo $row['numero']; ?>" id="numero" class="form-control input-lg" placeholder="Número da Sala" tabindex="3" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="btn-edita" value="Atualizar Sala" class="btn btn-warning btn-block btn-lg" tabindex="5"></div>
				</div><br>
			</form>
		</div>
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>

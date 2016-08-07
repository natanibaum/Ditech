<?php
require_once('includes/config.php');
require_once('classes/usuario.php');
$usuario= new Usuario();
$id = $_POST['id'];
//Método da classe usuario popula Usuário para edição 
$row = $usuario->Usuario($id);	

//Processo de update
if(isset($_POST['btn-edita'])){
	$nome = $_POST['nome'];
	$senha= $_POST['senha'];
	$id = $_POST['id'];
	//Instancia o método da classe de atualizacao de sala
	if( $usuario->AtualizaUsuario($nome,$senha,$id)){ 
		header('Location: perfil.php?action=upFeitoPessoa');
		exit;
	
	}

}


$title = 'Ditech | Edição de Usuário';

//inclui cabeçalho
require('layout/header.php'); 
?>

	
<div class="container">

	<div class="row">

	   <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
	   <br>
         <h4>Edição de 	Usuário</h4>
			<form  name="cadastro" role="form" method="post" action="" autocomplete="off" onSubmit="return validaEdicaoUsuario();">
				<hr>
				<input name='id' type='hidden' value="<?php echo $row['id'];?>">
				<div class="form-group">
					<input type="text" name="nome" id="nome"  value="<?php echo $row['nomeUsuario']; ?>"class="form-control input-lg" placeholder="Nome do Usuario" tabindex="1" required>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="senha" value="<?php echo $row['senha']; ?>" id="numero" class="form-control input-lg" placeholder="Senha" tabindex="3" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="btn-edita" value="Atualizar Usuário" class="btn btn-warning btn-block btn-lg" tabindex="5"></div>
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

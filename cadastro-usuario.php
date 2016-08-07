<?php 
require('includes/config.php');
require_once('classes/usuario.php');
$usuario = new USUARIO();
//Processo do formulário enviado
if(isset($_POST['submit'])){
	
		$ativacao = 'Sim';
		$user=$_POST['usuario'];
		$senha=$_POST['senha'];
		$senhaC=$_POST['senhaConfirma'];
	   if((empty($user))or (empty($senha)) or (empty ($senhaC)) or ($senha != $senhaC)){
		echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/cadastro-usuario.php?action=erro'</script>";
		}
		else{
	//se estiver todo o formulário preenchido, efetua o cadastro
	$usuario->InsereUsuario($user,$senha,$ativacao);
	}
}
	

//Define o titulo da página
$title = 'Ditech | Cadastrar-se';

//inclui o template header da página html com o css do layout
require('layout/header.php');
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
			<form  name="cadastro" id="fcadastro" role="form" method="post" action=""  autocomplete="off" onsubmit="return validaUsuario();">
				<h4>Sistema de Reservas</h4>
				<p>Você já possui cadastro? <a href='/ditech/index.php'>Login</a></p>
				<hr>

				<?php
				//Se houver erros
				if(isset($_GET['action']) && $_GET['action'] == 'falha'){
					echo "<h5 class='bg-danger color-red'>O usuário informado já está cadastrado!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'erro'){
					echo "<h5 class='bg-danger color-red'>Favor, preencha os campos corretamente! Lembrando que as senhas devem ser iguais.</h5>";
				}
				?>

				<div class="form-group">
					<input type="text" name="usuario" id="usuario" class="form-control input-lg" placeholder="Usuário"  tabindex="1"required>
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="senha" id="senha" class="form-control input-lg" placeholder="Senha" tabindex="3" required>
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="senhaConfirma" id="senhaConfirma" class="form-control input-lg" placeholder="Confirmar Senha" tabindex="4"required>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Cadastrar-se" class="btn btn-warning btn-block btn-lg" tabindex="5"></div>
				</div><br>
			</form>
		</div>
	</div>

</div><br><br>

<?php
//inclui o rodapé da página
require('layout/footer.php');
?>

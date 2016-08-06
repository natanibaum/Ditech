<?php 
require('includes/config.php');
require_once('usuario.php');
$usuario = new USUARIO();


//Processo do formulário enviado
if(isset($_POST['submit'])){
	
		$ativacao = 'Sim';
		$user=$_POST['usuario'];
		$senha=$_POST['senha'];
		$senhaConfirma=$_POST['senhaConfirma'];

	//Validações do formulário
	if(strlen($user) < 3){
		$error[] = 'O usuário informado é muito curto.';
	} 

	if(strlen($senha) < 3){
		$error[] = 'A senha é muito curta.';
	}

	if(strlen($senhaConfirma) < 3){
		$error[] = 'A senha confirmada é muito curta.';
	}

	if($senha!= $senhaConfirma){
		$error[] = 'As senhas NÃO são iguais, favor preencha novamente.';
	}

	//se estiver todo o formulário preenchido, efetua o cadastro
	$usuario->InsereUsuario($user,$senha,$ativacao);
		

}

//Define o titulo da página
$title = 'Ditech | Cadastrar-se';

//inclui o template header da página html com o css do layout
require('layout/header.php');
?>


<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
			<form  role="form" method="post" action="" autocomplete="off">
				<h4>Sistema de Reservas</h4>
				<p>Você já possui cadastro? <a href='/ditech/index.php'>Login</a></p>
				<hr>

				<?php
				//Se houver erros
				if(isset($_GET['action']) && $_GET['action'] == 'falha'){
					echo "<h5 class='bg-danger color-red'>O usuário informado já está cadastrado!</h5>";
				}
				?>

				<div class="form-group">
					<input type="text" name="usuario" id="usuario" class="form-control input-lg" placeholder="Usuário" value="<?php if(isset($error)){ echo $_POST['usuario']; } ?>" tabindex="1">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="senha" id="senha" class="form-control input-lg" placeholder="Senha" tabindex="3">
						</div>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="password" name="senhaConfirma" id="senhaConfirma" class="form-control input-lg" placeholder="Confirmar Senha" tabindex="4">
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

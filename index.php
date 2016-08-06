<?php
session_start();
require_once('includes/config.php');
require_once('usuario.php');
$usuario = new USUARIO();

//Processo de efetuação do login
if(isset($_POST['submit'])){
	$user = $_POST['usuario'];
	$senha = $_POST['senha'];
	//Instancia o método da classe usuário para validar o login
	if($usuario->login($user,$senha)){ 
	    $_SESSION['usuario'] = $user;
		header('Location: memberpage.php');
		exit;
	
	}

}


$title = 'Ditech | Login';

//include header template
require('layout/header.php'); 
?>

	
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
			<form role="form" method="post" action="" autocomplete="off">
				<h4>Sistema de Reservas | Login</h4><br>
				<p>Você não possui usuário cadastrado? <a href='cadastro.php'>Cadastre-se já!</a></p>
				<hr>

				<?php
				//Se ocorrer o falha no login
				if(isset($_GET['action']) && $_GET['action'] == 'falhaLogin'){
					echo "<h5 class='bg-danger color-red'>Você precisa preencher o usuário e senha corretamente para fazer o login!</h5>";
				}
			    //Se ocorrer o cadastro feito
				if(isset($_GET['action']) && $_GET['action'] == 'cadastroFeito'){
					echo "<h5 class='bg-success color-green'>Seu cadastro foi realizado com sucesso! Efetue já o seu primeiro login</h5>";
				}
				?>

				<div class="form-group">
					<input type="text" name="usuario" id="usuario" class="form-control input-lg" placeholder="Usuário" value="<?php if(isset($error)){ echo $_POST['usuario']; } ?>" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="senha" id="senha" class="form-control input-lg" placeholder="Senha" tabindex="3">
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Efetuar Login" class="btn btn-warning btn-block btn-lg" tabindex="5"></div>
				</div><br>
			</form>
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>

<?php
session_start();
require_once('includes/config.php');
require_once('usuario.php');
$usuario = new USUARIO();

//Processo de efetuação do login
if(isset($_POST['btn-login'])){
	$user = $_POST['usuario'];
	$senha = $_POST['senha'];
		if(empty($user) or (empty($senha))){
	   echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/index.php?action=errologin'</script>";
		}else{
			//Instancia o método da classe usuário para validar o login
			if($usuario->validaLogin($user,$senha)){ 
				$_SESSION['usuario']= $user;
				header('Location: perfil.php');
				exit;
			
			}

	}
}


$title = 'Ditech | Login';

//inclui cabeçalho
require('layout/header.php'); 
?>

	
<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
			<form role="form" method="POST" action="" autocomplete="off">
				<h4>Sistema de Reservas | Login</h4><br>
				<p>Você não possui usuário cadastrado? <a href='cadastro.php'>Cadastre-se já!</a></p>
				<hr>

				<?php
				//Se ocorrer o falha no login
				if(isset($_GET['action']) && $_GET['action'] == 'falhaLogin'){
					echo "<h5 class='bg-danger color-red'>Você precisa preencher o usuário e senha corretamente para fazer o login!</h5>";
				}
				//Se ocorrer o falha no login
				if(isset($_GET['action']) && $_GET['action'] == 'errologin'){
					echo "<h5 class='bg-danger color-red'>Você precisa preencher o usuário e senha corretamente para fazer o login!</h5>";
				}
			    //Se ocorrer o cadastro feito
				if(isset($_GET['action']) && $_GET['action'] == 'cadastroFeito'){
					echo "<h5 class='bg-success color-green'>Seu cadastro foi realizado com sucesso! Efetue já o seu primeiro login</h5>";
				}
				?>

				<div class="form-group">
					<input type="text" name="usuario" id="usuario" class="form-control input-lg" placeholder="Usuário" tabindex="1">
				</div>

				<div class="form-group">
					<input type="password" name="senha" id="senha" class="form-control input-lg" placeholder="Senha" tabindex="3">
				</div>
				<hr>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="btn-login" value="Efetuar Login" class="btn btn-warning btn-block btn-lg" tabindex="5"></div>
				</div><br>
			</form>
		</div>
	</div>



</div>


<?php 
//include header template
require('layout/footer.php'); 
?>

<?php 
require('includes/config.php'); 
require_once('usuario.php');
$usuario = new USUARIO();
session_start();
//Se o usuário não estiver logado
if(!$usuario->logado()){ 
	header('Location: /ditech/index.php');
	
}
//define o titulo da página
$title = 'Ditech | Sistema de Reservas';

//inclui o cabeçalho da pagina
require('layout/header.php'); 
?>

<div class="container">

	<div class="row">

	    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
			
				<h2>Ditech :. Sistema de Reservas - Olá <?php echo $_SESSION['usuario']; ?></h2>
				<p><a href='logout.php'>Logout</a></p>
				<hr>

		</div>
	</div>


</div>

<?php 
//inclui o rodapé da página
require('layout/footer.php'); 
?>

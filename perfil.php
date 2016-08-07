<?php 
require('includes/config.php'); 
require_once('classes/usuario.php');
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

<div class="container form">
  <h4>Ditech :. Sistema de Reservas .:</h4><br>
  <a href='logout.php'><span class="glyphicon glyphicon-log-out"></span> Sair do Sistema</a><br><br>
<?php
				//Se houver erros
				if(isset($_GET['action']) && $_GET['action'] == 'salaExiste'){
					echo "<h5 class='bg-danger color-red'>O nome e número da sala já existe!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'formSalaErro'){
					echo "<h5 class='bg-danger color-red'>Preencha corretamente o formulário de Cadastro de Salas!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'errodelete'){
					echo "<h5 class='bg-danger color-red'>Você não pode excluir pois há uma reserva nesta sala!</h5>";
				}
				//Se houver sucesso
				if(isset($_GET['action']) && $_GET['action'] == 'cadastroFeitoSala'){
					echo "<h5 class='bg-success color-green'>A sala foi cadastrada com sucesso!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'upFeitoSala'){
					echo "<h5 class='bg-success color-green'>A sala foi atualizada com sucesso!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'reservaok'){
					echo "<h5 class='bg-success color-green'>A sala foi reservada no horário escolhido com sucesso!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'deleteFeitoSala'){
					echo "<h5 class='bg-success color-green'>A sala foi excluída com sucesso!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'deleteFeitoReserva'){
					echo "<h5 class='bg-success color-green'>A reserva foi excluída com sucesso!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'upFeitoPessoa'){
					echo "<h5 class='bg-success color-green'>Usuário atualizado com sucesso!</h5>";
				}
				if(isset($_GET['action']) && $_GET['action'] == 'deleteUsuario'){
					echo "<h5 class='bg-success color-green'>Após fazer logoff seu usuário estará desativado.</h5>";
				}
 ?>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Reservas Disponíveis</a></li>
    <li><a data-toggle="tab" href="#menu2">Registro de Salas</a></li>
    <li><a data-toggle="tab" href="#menu3">Edições de Salas</a></li>
	 <li><a data-toggle="tab" href="#menu4">Edição de Usuário</a></li>
  </ul>
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
	  <?php include('salas-disponiveis.php');?>
      <?php include('salas-indisponiveis.php');?>
    </div>
    <div id="menu2" class="tab-pane fade">
	   <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form">
	   <h3>Cadastro de Salas</h3>
	   <br>
         <p>Cadastre as salas de reuniões da sua empresa.</p>
			<form  role="form" method="post" action="cadastro-sala.php" autocomplete="off">
				<hr>
				<div class="form-group">
					<input type="text" name="nome" id="nome" class="form-control input-lg" placeholder="Nome da Sala" tabindex="1">
				</div>
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<div class="form-group">
							<input type="number" name="numero" id="numero" class="form-control input-lg" placeholder="Número da Sala" tabindex="3">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-6 col-md-6"><input type="submit" name="submit" value="Cadastrar Sala" class="btn btn-warning btn-block btn-lg" tabindex="5"></div>
				</div><br>
			</form>
		</div>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Edições de Salas</h3>
	  <br>
		<?php include('salas-cadastradas.php');?>
    </div>
	 <div id="menu4" class="tab-pane fade">
      <h3>Edição de Usuário</h3>
	  <br>
		<?php include('edicao-usuario.php');?>
    </div>
  </div>
</div>

<?php 
//inclui o rodapé da página
require('layout/footer.php'); 
?>

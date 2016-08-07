<?php
require('includes/config.php');
require_once('classes/sala.php');
$sala = new SALA();
	
		$nome = $_POST['nome'];
		$numero = $_POST['numero'];

	//Validações do formulário
	if(empty($nome) or (empty($numero))){
	   echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/perfil.php?action=formSalaErro'</script>";
		}
	else{
	//se estiver todo o formulário preenchido, efetua o cadastro
	$sala->InsereSala($nome,$numero);
	}	

?>
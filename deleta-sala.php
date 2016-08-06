<?php
require_once('includes/config.php');
require_once('sala.php');
$sala= new SALA();
$id = $_POST['id'];
	//Instancia o método da classe de atualizacao de sala
	if( $sala->ExcluiSala($id)){ 
		header('Location: perfil.php?action=deleteFeitoSala');
		exit;
	
	}
?>
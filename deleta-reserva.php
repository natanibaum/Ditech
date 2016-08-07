<?php
require_once('includes/config.php');
require_once('classes/reserva.php');
$reserva= new Reserva();
$id = $_POST['id'];
	//Instancia o método da classe de atualizacao de sala
	if( $reserva->ExcluiReserva($id)){ 
		header('Location: perfil.php?action=deleteFeitoReserva');
		exit;
	
	}
?>
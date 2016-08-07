<?php
require('includes/config.php');
require_once('reserva.php');
$reserva= new RESERVA();
	
		$salaid = $_POST['sala'];
		$idhr = $_POST['idhr'];
		$hrini = $_POST['hr_ini'];
		$userid = $_POST['user'];
	//Função insere a reserva
	$reserva->InsereReserva($userid,$salaid,$hrini,$idhr);	

?>
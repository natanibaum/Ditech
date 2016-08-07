<?php
require('includes/config.php');
require_once('classes/reserva.php');
$reserva= new RESERVA();
	
		$salaid = $_POST['sala'];
		$idhr = $_POST['idhr'];
		$hrini = $_POST['hr_ini'];
		$userid = $_POST['user'];
	//Função insere a reserva
	if($reserva->InsereReserva($userid,$salaid,$hrini,$idhr)){
		echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/perfil.php?action=reservaok'</script>";
	}	

?>
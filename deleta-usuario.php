<?php
require_once('includes/config.php');
require_once('usuario.php');
$usuario= new USUARIO();
$id = $_POST['id'];
	//Instancia o método da classe de atualizacao de sala
	if( $usuario->ExcluiUsuario($id)){ 
		header('Location: perfil.php?action=deleteUsuario');
		exit;
	
	}
?>
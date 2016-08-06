<?php 
require('usuario.php');
$usuario = new USUARIO();

//logout
$usuario->logout(); 
header("Location: /ditech/");
exit;
?>
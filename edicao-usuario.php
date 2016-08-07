<?php
require_once('includes/config.php');
require_once('classes/usuario.php');
$usuario=new Usuario();
	  //querie popula  usuario
		$idu= $_SESSION['id'];
		$row_user = $usuario->Usuario($idu);
		echo"
			<table width='50%' class='table table-striped'>
			<thead>
			  <tr>
				<th><h4>Usuário de Login</h4></th>
			  </tr>
			</thead>
			<tbody>
			<tr>
			 ";
			echo"<form method='Post'  action='edita-usuario.php'>
				<tr>
				<td>
				<input name='id' id=id' type='hidden' value=". $row_user['id'].">";
			echo $row_user['nomeUsuario'];
			
			echo"</td>
				<td><button type='submit' class='btn btn-warning'>Editar</button></td>
				</form>
				<form method='Post' action='deleta-usuario.php'>
				<input name='id' id=id' type='hidden' value=". $row_user['id'].">
				<td><button type='submit' class='btn btn-danger'>Excluir</button></td>
				</form>
				</tr>
				";
		 echo"
			</tr>
			</tbody>
		  </table>
		  ";
			

?>
<?php
require_once('includes/config.php');
require_once('classes/sala.php');
$salas = new SALA();
$valida=0;
		//Método publico da classe sala que retorna a query
		$resultado = $salas->buscaSalasDisponiveis();
		echo"
			<table width='50%' class='table table-striped'>
			<thead>
			  <tr>
				<th><h4>Salas Cadastradas</h4></th>
			  </tr>
			</thead>
			<tbody>
			<tr>
			 ";
		//Coleções de todas as salas trazidas na query da classe SALA.
		foreach($resultado as $row)
		{
			$valida=1;
			echo"<form method='Post'  action='edita-sala.php'>
				<tr>
				<td>
				<input name='id' id=id' type='hidden' value=". $row['id'].">";
			echo $row['nome'];
			
			echo"</td>
				<td>";
		    echo $row ['numero'];
			echo"</td>
				<td><button type='submit' class='btn btn-warning'>Editar</button></td>
				</form>
				<form method='Post' action='deleta-sala.php'>
				<input name='id' id=id' type='hidden' value=". $row['id'].">
				<td><button type='submit' class='btn btn-danger'>Excluir</button></td>
				</form>
				</tr>
				";
		}
		if($valida!=1){
			echo"<p class='bg-danger color-red'>Não há salas cadastradas!</p>";
		}
		 echo"
			</tr>
			</tbody>
		  </table>
		  ";
			

?>
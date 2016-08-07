<?php
require_once('includes/config.php');
require_once('classes/sala.php');
$sala= new SALA();
$valida =0;
		//Método que retorna a querie de todas as salas indisponíveis na classe sala
		$resultado = $sala->buscaSalasIndisponiveis();
		echo"
			<table width='30%' class='table table-striped'>
			<thead><hr>
			  <tr>
				<th><h2 style='color:red;'>Salas Ocupadas</h2></th>
			  </tr>
			</thead>
			<tbody>
			<tr>
			 ";
		foreach($resultado as $row)
		{
			$valida=1;
			echo"
				<tr>
				<td>";
			echo "<h4>".$row['nome']."</h4>";
		    echo "<h4>Nº: ".$row['numero']."</h4>";
			echo"</td>
				";
			echo "<th>";
			echo $row['hr_ini']; 
			echo"<br>";
			echo $row['hr_fim'];
				echo"<br><br><h3 class='bg-danger color-red'><b>Reservado por: ".$row['nomeUsuario']."</b></h3>";
				if($row['nomeUsuario']== $_SESSION['usuario']){
					echo"<form method='post' action='deleta-reserva.php'>";
					echo "<input name='id' id=id' type='hidden' value=". $row['id'].">";
					echo"<button class='btn btn-danger'type='submit'>Excluir Reserva</button>";
					echo"</form>";
					
				}
			echo "</th>";
				echo"</tr>
				";
					  
		}
		echo"
			</tr>
			</tbody>
		  </table>
		  ";
		if($valida!=1){
			echo"<p class='bg-danger color-red'>Não há salas ocupadas!</p>";
		}
		
			

?>
<?php
require_once('includes/config.php');
require_once('classes/sala.php');
require_once('classes/reserva.php');
require_once('classes/usuario.php');
$sala = new SALA();
$reserva= new Reserva();
$usuario = new Usuario();
		//Popula variavel com o id do usuário que está na sessão
		$userid= $_SESSION['id'];
		$resultado = $sala->buscaSalasDisponiveis();	
		echo"
			<table width='30%' class='table table-striped'>
			<thead>
			  <tr>
				<th><h2 style='color:green;'>Salas Disponíveis </h2></th>
			  </tr>
			</thead>
			<tbody>
			<tr>
			 ";
			 if(empty($resultado)){
						echo"<td>
						<p class='bg-danger color-red'>Não há salas cadastradas.</p>
						</td>";
						}
		//Coleção das salas disponiveis
		foreach($resultado as $row)
		{	$valida=1; 
			$salaid=$row['id'];
			echo"<tr>
				<td>
				";
			echo "<h4>".$row['nome']."</h4>";
		    echo "<h4>Nº: ".$row['numero']."</h4>";
			
				//Instancia do método da classe reserva que retorna todos os horários disponiveis por sala
				$row_hr= $reserva->buscaHorariosDisponiveis($salaid);
				if(empty($row_hr)){
						echo"<p class='bg-danger color-red'>Não há horários disponíveis para esta sala.</p>";
						}
					echo"</td>
						";
				//coleçao dos horarios disponiveis
				foreach($row_hr as $h)
				{
					echo"<form method='Post'  action='cadastra-reserva.php'>";
					echo"<input name='idhr' id=idhr' type='hidden' value=". $h['id'].">";
					echo"<input name='hr_ini' id='hr_ini' type='hidden' value=". $h['hr_ini'].">";
					echo"<input name='user' id=user' type='hidden' value=". $userid.">";
					echo "<input name='sala' id=idsala' type='hidden' value=". $row['id'].">";
					echo "<th>";
					echo $h['hr_ini']; 
					echo"<br>";
					echo $h['hr_fim'];
				
						echo"<br><br><button type='submit' class='btn btn-success'>Reservar</button>";
					}
					echo "</th>";
				 echo"</form>";	
					
				}	
				echo"</tr>
				";			
		
		 echo"
			</tr>
			</tbody>
		  </table>
		  ";
			

?>
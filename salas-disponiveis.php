<?php
require_once('includes/config.php');

$database = new Database();
$conn = $database->dbConnection();
$valida =0;

	//querie Salas disponiveis
		$stmt = $conn->prepare("SELECT id,nome,numero 
								FROM Salas;");
		$stmt->execute();
		$resultado = $stmt->fetchAll();	
		//querie popula id usuario
		$nome= $_SESSION['usuario'];
		$user = $conn->prepare("SELECT id FROM Usuario where nomeUsuario = :nome");
		$user->execute(array(':nome' => $nome));
		$row_user = $user->fetch(PDO::FETCH_ASSOC);
		
		echo"
			<table width='30%' class='table table-striped'>
			<thead><hr>
			  <tr>
				<th><h2 style='color:green;'>Salas Disponíveis </h2></th>
			  </tr>
			</thead>
			<tbody>
			<tr>
			 ";
		foreach($resultado as $row)
		{	 echo"<form method='Post'  action='cadastra-reserva.php'>";
			$valida=1;
			$salaid=$row['id'];
			echo"<tr>
				<td>
				<input name='sala' id=idsala' type='hidden' value=". $row['id'].">";
			echo"<input name='user' id=user' type='hidden' value=". $row_user['id'].">";
			echo "<h4>".$row['nome']."</h4>";
		    echo "<h4>Nº: ".$row['numero']."</h4>";
			echo"</td>
				";
				//query horarios
				$hr = $conn->prepare("
								SELECT h.id,h.hr_ini,h.hr_fim
								FROM Horario h
								WHERE NOT EXISTS (SELECT * FROM  Reserva r,Salas s
												  WHERE h.id = r.hr_id 
												  And s.id=r.sala_id
												  And s.id='$salaid'
													);");
				$hr->execute();
				$row_hr= $hr->fetchAll();
				foreach($row_hr as $h)
				{	echo"<form method='Post'  action='cadastra-reserva.php'>";
					echo"<input name='idhr' id=idhr' type='hidden' value=". $h['id'].">";
					echo"<input name='hr_ini' id='hr_ini' type='hidden' value=". $h['hr_ini'].">";
					echo "<th>";
					echo $h['hr_ini']; 
					echo"<br>";
					echo $h['hr_fim'];
						echo"<br><br><button type='submit' class='btn btn-success'>Reservar</button>";
					echo "</th>";
				 echo"</form>";	
					
				}
				echo"</tr>
				</form>";	  
		}
		if($valida!=1){
			echo"<p class='bg-danger color-red'>Não há salas disponíveis!</p>";
		}
		 echo"
			</tr>
			</tbody>
		  </table>
		  ";
			

?>
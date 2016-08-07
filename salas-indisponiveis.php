<?php
require_once('includes/config.php');

$database = new Database();
$conn = $database->dbConnection();
$valida =0;

	//querie Salas ocupadas
		$stmt = $conn->prepare("Select  s.nome,
										s.numero,
										u.nomeUsuario,
										h.hr_ini,
										h.hr_fim,
										r.id
								FROM Salas s,
									 Reserva r,
									 Usuario u,
									 Horario h
								where s.id=r.sala_id
								And u.id= r.usuario_id
								And h.id= r.hr_id;");
		$stmt->execute();
		$resultado = $stmt->fetchAll();	
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
				echo"<br><br><h3 class='bg-danger color-red'>Reservado por:".$row['nomeUsuario']."</h3>";
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
		if($valida!=1){
			echo"<p class='bg-danger color-red'>Não há salas disponíveis!</p>";
		}
		 echo"
			</tr>
			</tbody>
		  </table>
		  ";
			

?>
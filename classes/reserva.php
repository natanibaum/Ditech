<?php
require_once('includes/config.php');

class RESERVA{

	private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$conn = $database->dbConnection();
		$this->conn = $conn;
    }
	//Função que executa as queries
	private function rodaQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}
	private function validaUsuarioInativo($id){
		$stmt = $this->rodaQuery('SELECT nomeUsuario FROM Usuario WHERE id = :user And ativo="Não" ');
		$stmt->execute(array(':user' => $id));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['nomeUsuario'])){
			return true;
		}
		
	}
	//Método Cadastra o usuário no banco
	public function InsereReserva($userid,$salaid,$hr_ini,$hrid){
	
	try {	
		if($this->validaUsuarioInativo($userid)){
		   header('Location: /ditech/perfil.php?action=naopodereservar');
		}
		else{
			$stmt = $this->rodaQuery('INSERT INTO Reserva (usuario_id,sala_id,hr_ini,hr_id) VALUES (:usuario,:sala,:hrini,:hrid)');
			$stmt->execute(array(
				':usuario' => $userid,
				':sala' => $salaid,
				':hrini'=>$hr_ini,
				':hrid'=>$hrid
				
			));
			 return true;
		}
	}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	 	//Método deleta reserva
	public function ExcluiReserva($id){
		try {	
			$stmt = $this->rodaQuery('Delete from Reserva where id = :id');
			$stmt->execute(array(
				':id'=>$id
			));
			return true;
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	 //Método public que busca todas os horarios disponiveis
	 public function buscaHorariosDisponiveis($salaid){
		 	try {
			$stmt = $this->rodaQuery("SELECT h.id,h.hr_ini,h.hr_fim
									FROM Horario h
									WHERE NOT EXISTS (SELECT * FROM  Reserva r,Salas s
													  WHERE h.id = r.hr_id 
													  And s.id=r.sala_id
													  And s.id='$salaid')
											");
			$stmt->execute();
			return $stmt->fetchAll();	

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }




}

?>

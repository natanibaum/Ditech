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
	//Método Cadastra o usuário no banco
	public function InsereReserva($userid,$salaid,$hr_ini,$hrid){
	
		try {	
			$stmt = $this->rodaQuery('INSERT INTO Reserva (usuario_id,sala_id,hr_ini,hr_id) VALUES (:usuario,:sala,:hrini,:hrid)');
			$stmt->execute(array(
				':usuario' => $userid,
				':sala' => $salaid,
				':hrini'=>$hr_ini,
				':hrid'=>$hrid
				
			));
			 echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/perfil.php?action=reservaok'</script>";
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	 	//Método deleta
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



}

?>

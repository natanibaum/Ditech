<?php
require_once('includes/config.php');

class SALA{

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
	//Método privado da própria classe que valida se o usuario existe
	public function validaSala($nome,$numero){
		$stmt = $this->rodaQuery("SELECT nome, numero FROM Salas WHERE nome = :sala And numero = :numero");
		$stmt->execute(array(':sala' => $nome, ':numero'=> $numero));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['nome'])){
			header('Location: /ditech/perfil.php?action=falha');
			return true;
		}
		
	}
	//Método Cadastra o usuário no banco
	public function InsereSala($nome,$numero){
		if($this->validaSala($nome,$numero)){
			header('Location: /ditech/perfil.php?action=salaExiste');
		}
		else{
		try {	
			$stmt = $this->rodaQuery('INSERT INTO Salas (nome,numero) VALUES (:nome,:numero)');
			$stmt->execute(array(
				':nome' => $nome,
				':numero' => $numero
			));
			 echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/perfil.php?action=cadastroFeitoSala'</script>";
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	}
	//Método Atualiza sala no banco
	public function AtualizaSala($nome,$numero,$id){
		try {	
			$stmt = $this->rodaQuery('Update Salas set nome= :nome, numero= :numero where id= :id');
			$stmt->execute(array(
				':nome' => $nome,
				':numero' => $numero,
				':id'=>$id
			));
			 echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/perfil.php?action=upFeitoSala'</script>";
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	 	//Método Cadastra o usuário no banco
	public function ExcluiSala($id){
		try {	
			$stmt = $this->rodaQuery('Delete from Salas where id = :id');
			$stmt->execute(array(
				':id'=>$id
			));
			echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/perfil.php?action=deleteFeitoSala'</script>";
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }



}

?>

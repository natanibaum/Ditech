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
	//Método privado da própria classe que valida se sala existe
	private function validaSala($nome,$numero){
		$stmt = $this->rodaQuery("SELECT nome, numero FROM Salas WHERE nome = :sala And numero = :numero");
		$stmt->execute(array(':sala' => $nome, ':numero'=> $numero));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['nome'])){
			header('Location: /ditech/perfil.php?action=falha');
			return true;
		}
		
	}
	//Método Cadastra o sala no banco
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
	 	//Método Exclui sala
	public function ExcluiSala($id){
		try {	
			$stmt = $this->rodaQuery('Delete from Salas where id = :id');
			$stmt->execute(array(
				':id'=>$id
			));
			return true;
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	 //Método public que busca todas as salas cadastradas
	 public function buscaSalasDisponiveis(){
		 	try {
			$stmt = $this->rodaQuery("SELECT id,nome,numero FROM Salas");
			$stmt->execute();
			return $stmt->fetchAll();	

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	//Método public que busca todas as salas indisponiveis
	 public function buscaSalasIndisponiveis(){
		 	try {
			$stmt = $this->rodaQuery(" Select  s.nome,
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
										And h.id= r.hr_id ");
			$stmt->execute();
			return $stmt->fetchAll();	

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	 //Método que popula sala para edições
	 public function Sala($id){
		 	try {
			$stmt = $this->rodaQuery("SELECT id,nome,numero FROM Salas where id = :id");
			$stmt->execute(array(':id' => $id));
			return $stmt->fetch(PDO::FETCH_ASSOC);	

		} catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }


}

?>

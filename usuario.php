<?php
require_once('includes/config.php');

class USUARIO{

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
	public function validaUsuario($usuario){
		$stmt = $this->rodaQuery("SELECT nomeUsuario FROM Usuario WHERE nomeUsuario = :user");
		$stmt->execute(array(':user' => $usuario));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['nomeUsuario'])){
			return true;
		}
		
	}
	//Método privado da própria classe que valida se o login do usuário
	public function validaLogin($usuario,$senha){
		$stmt = $this->rodaQuery('SELECT nomeUsuario,id FROM Usuario WHERE nomeUsuario = :user And senha = :senha And ativo="Sim"');
		$stmt->execute(array(':user' => $usuario, ':senha'=> $senha));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['nomeUsuario'])){
			$_SESSION['usuario'] = $row['nomeUsuario'];
			$_SESSION['id'] = $row['id'];
			$_SESSION['loggedin'] = true;
			return true;
		}
		
	}
	//Método Cadastra o usuário no banco
	public function InsereUsuario($username,$senha,$ativo){
		if($this->validaUsuario($username)){
			header('Location: /ditech/cadastro.php?action=falha');
		}
		else{
		try {	
			$stmt = $this->rodaQuery('INSERT INTO Usuario (nomeUsuario,senha,ativo) VALUES (:usuario, :senha,:ativacao)');
			$stmt->execute(array(
				':usuario' => $username,
				':senha' => $senha,
				':ativacao' => $ativo
			));
			 echo"<script language='javascript' type='text/javascript'>window.location.href='/ditech/index.php?action=cadastroFeito'</script>";
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	}
		public function AtualizaUsuario($nome,$senha,$id){
		try {	
			$stmt = $this->rodaQuery('Update Usuario set nomeUsuario = :nome, senha= :senha where id= :id');
			$stmt->execute(array(
				':nome' => $nome,
				':senha' => $senha,
				':id'=>$id
			));
			return true;
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }
	 public function ExcluiUsuario($id){
		try {	
			$stmt = $this->rodaQuery('Update Usuario set ativo = "Não" where id= :id');
			$stmt->execute(array(
				':id'=>$id
			));
			return true;
		}catch(PDOException $e) {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	 }

//Função logoff
	public function logout(){
		session_start();
		session_destroy();
		unset($_SESSION['usuario']);
		return true;
	}

	public function logado(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}


}

?>

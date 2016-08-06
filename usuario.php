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
	//Função que valida se o usuario existe
	private function validaUsuario($usuario){
		$stmt = $this->rodaQuery("SELECT nomeUsuario FROM Usuario WHERE nomeUsuario = :user");
		$stmt->execute(array(':user' => $usuario));
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!empty($row['nomeUsuario'])){
		 return true;
		}
		
	}
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

	public function login($username,$senha){

	try
		{
			$stmt = $this->rodaQuery('SELECT nomeUsuario FROM Usuario WHERE nomeUsuario =:unome AND senha =:usenha ');
			$stmt->execute(array(':unome'=>$username, ':usenha'=>$senha));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
				if(!empty($row['nomeUsuario']))
				{		
						$_SESSION['loggedin'] = true;
						$_SESSION['usuario'] = $row['nomeUsuario'];
						return true;
				}
				else{
						header('Location: /ditech/index.php?action=falhaLogin');
						return false;
				}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	
	public function logout(){
		session_destroy();
	}

	public function logado(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
			return true;
		}
	}


}

?>

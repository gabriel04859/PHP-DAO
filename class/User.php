<?php
class User{
	private $idUser;
	private $name;
	private $email;
	private $password;

	public function getIdUser(){
		$this->idUser;
	}

	public function getName(){
		$this->name;
	}

	public function getEmail(){
		$this->email;
	}

	public function getPassword(){
		$this->password;
	}

	public function setIdUser($idUser){
		$this->idUser = $idUser;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setPassword($password){
		$this->password = $password;
	}

	

	public function getById($id){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_user WHERE id = :id", array(
			":id"=>$id));

		if (count($result) > 0) {
			$row = $result[0];
			$this->setIdUser($row['id']);
			$this->setName($row['name']);
			$this->setEmail($row['email']);
			$this->setPassword($row['password']);
		}
	}

	public static function getAllUsers(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_user ORDER BY id;");

}

public static function searchUser($name){
	$sql = new Sql();
	return $sql->select("SELECT * FROM tb_user WHERE name LIKE :SEARCH", array(
		':SEARCH'=>"%".$name."%"));

}

public function login($email , $password){
	$sql = new Sql();
	$result = $sql->select("SELECT * FROM tb_user WHERE email = :EMAIL AND password = :PASSWORD", array(
		':EMAIL'=>$email,
		':PASSWORD'=>$password));

	if (count($result) > 0){
		$row = $result[0];
		$this->setIdUser($row['id']);
		$this->setName($row['name']);
		$this->setEmail($row['email']);
		$this->setPassword($row['password']);
		
	}else{
		throw new Exception("Email ou senha incorreto");
		
	}
}

}


?>
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

	public function __contruct($name, $email, $password){
		$this->name = $name;
		$this->email = $email;
		$this->password = $password;
	}

	public function getById($id){
		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_user WHERE id = :id", array(
			":id"=>$id));

		if (count($result) > 0) {
			$this->setData($result[0]);
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
		$this->setData($result[0]);
		
	}else{
		throw new Exception("Email ou senha incorreto");
		
	}
}

public function insertUser(){
	$sql = new Sql();
	$result = $sql->select("CALL sp_user_insert(:NAME, :EMAIL, :PASSWORD)",array(
		':NAME'=>$this->getName(),
		':EMAIL'=>$this->getEmail(),
		':PASSWORD'=>$this->getPassword()
	));
	if (count($result) > 0) {
		$this->setData($result);
		# code...
	}
}

public function update($id,$name, $email, $password){;
	$sql = new Sql();
	$sql->query("UPDATE tb_user SET name :NAME, email = :EMAIL, $password = :PASSWORD WHERE id = :ID", array(
		':ID'=>$id,
		':NAME'=>$name,
		':EMAIL'=>$email,
		':PASSWORD'=>$password

	));


}

public function delete(){
	$sql = new Sql();
	$sql->query("DELETE FROM tb_user WHERE id = :ID", array(
		':ID'=>$this->getIdUser()
	));
}

private function setData($data){
	$this->setIdUser($data['id']);
	$this->setName($data['name']);
	$this->setEmail($data['email']);
	$this->setPassword($data['password']);
	var_dump($data);
}

}


?>
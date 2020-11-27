<?php
class Sql extends PDO{

    private $connection;

    public function __construct(){
        try{
            $this->connection = new PDO("mysql:host=localhost;dbname=phpdao","root","");
           
        }catch(PDOException $error){
            echo "Erro ao conectar".$error->getMessage();
        }
        
    }

    public function query($rawQuery, $params = array()){
        $stmt = $this->connection->prepare($rawQuery);
        $this->setParams($stmt,$params);
        $stmt->execute();
        return $stmt;

       
    }

    public function select ($rawQuery, $params = array()) :array{
        $stmt = $this->query($rawQuery, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


private function setParams($statment, $parameters  = array()){
    foreach($parameters as $key => $value){
        $this->setParam($key, $value);
    }
}

private function setParam($statment, $key, $value){
    $statment->bindParam($key,$value);
}

}


?>
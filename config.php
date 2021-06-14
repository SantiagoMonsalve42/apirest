<?php

class configuration{
    
    public $dns="mysql:host=localhost;dbname=proyecto";
    public $user="root";
    public $pass='123456';

    public function getConection(){
        try {
            $conection = new PDO($this->dns, $this-> user, $this -> pass);
            return $conection;
        } catch (PDOException $e) {
            echo 'Falló la conexión: ' . $e->getMessage();
        }
    }
    public function getParams($statement,$strinfOfParams){

        foreach($strinfOfParams as $param => $value){
            $statement->bindValue(':'.$param,$value);
        }
        return $statement;
    }
}

?>
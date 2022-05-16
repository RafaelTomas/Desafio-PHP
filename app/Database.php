<?php

class Database {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $dbname = 'crud';


    public function conectar(){
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $conn = new PDO($dsn,"$this->user","$this->pass");
           return $conn;
        } catch (PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
        }

    }
}

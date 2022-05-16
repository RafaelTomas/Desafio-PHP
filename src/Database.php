<?php

class Database {

    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $banco = 'crud';
    private $porta = '3306';

    public function conectar(){
        try {
            $dsn = 'mysql:host=' . $this->host . ';port=' . $this->porta . 'dbname=' . $this->banco;
            $conn = new PDO($dsn, $this->user, $this->pass);
           return $conn;
        } catch (PDOException $e) {
            echo '<p>'.$e->getMessage().'</p>';
        }

    }
}
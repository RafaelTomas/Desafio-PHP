<?php

class Tarefa{
    private $id;
    private $nome;
    private $tarefa;
    private $data_ini;
    private $data_fim;

    public function __get($atributo) {
       return $this->$atributo; 
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    
}
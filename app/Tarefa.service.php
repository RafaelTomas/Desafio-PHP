<?php

class TarefaService {
   
    private $conn;
    private $tarefa;

    public function __construct(Database $conn, Tarefa $tarefa)
    {
        $this->conn = $conn->conectar();
        $this->tarefa = $tarefa;

    }
    public function create(){
        $query = 'insert into tb_tarefas(tarefa)values(:tarefa)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }
    
    public function read(){
        $query = 'select t.id, s.status, tarefa from tb_tarefas as t left join tb_status as s on (t.id_status = s.id)';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function update(){}
    public function delete(){}

}


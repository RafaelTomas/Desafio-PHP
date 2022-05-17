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
    public function update(){
        $query = 'update tb_tarefas set tarefa = :tarefa where id= :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        $stmt->execute();
    }
    public function delete(){
        $query = 'delete from tb_tarefas where id= :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        $stmt->execute();
    
    }

    public function tarefaPendente()
    {
        $query = 'select t.id, s.status, tarefa from tb_tarefas as t left join tb_status as s on (t.id_status = s.id) where t.id_status = :id_status';

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        $stmt->execute();
    }
}


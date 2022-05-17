<?php

class TarefaService
{

    private $conn;
    private $tarefa;

    public function __construct(Database $conn, Tarefa $tarefa)
    {
        $this->conn = $conn->conectar();
        $this->tarefa = $tarefa;
    }
    public function create()
    {
        $query = 'insert into tb_tarefas(nome, descricao, data_ini, data_fim)
        values(:nome, :descricao, :data_ini, :data_fim)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':nome', $this->tarefa->__get('nome'));
        $stmt->bindValue(':descricao', $this->tarefa->__get('descricao'));
        $stmt->bindValue(':data_ini', $this->tarefa->__get('data_ini'));
        $stmt->bindValue(':data_fim', $this->tarefa->__get('data_fim'));
        $stmt->execute();
    }

    public function readAll()
    {
        $query = 'select t.id, s.status, nome, descricao, data_ini, data_fim 
        from tb_tarefas as t left join tb_status as s on (t.id_status = s.id)';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function readPending()
    {
        $query = 'select t.id, s.status, nome, descricao,  data_ini, data_fim 
        from tb_tarefas as t left join tb_status as s on (t.id_status = s.id)WHERE t.id_status = 1';
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function update()
    {
        $query = 'update tb_tarefas set nome= :nome, descricao = :descricao, data_ini= :data_ini, data_fim= :data_fim  where id= :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':descricao', $this->tarefa->__get('descricao'));
        $stmt->bindValue(':id', $this->tarefa->__get('id'));
        $stmt->bindValue(':nome', $this->tarefa->__get('nome'));
        $stmt->bindValue(':data_ini', $this->tarefa->__get('data_ini'));
        $stmt->bindValue(':data_fim', $this->tarefa->__get('data_fim'));

        $stmt->execute();
    }
    public function delete()
    {
        $query = 'delete from tb_tarefas where id= :id';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        $stmt->execute();
    }

    public function updateStatus($status)
    {
        $query = 'UPDATE tb_tarefas SET id_status= :id_status WHERE id = :id';

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id_status', $status);
        $stmt->bindValue(':id', $this->tarefa->__get('id'));

        $stmt->execute();
    }
}

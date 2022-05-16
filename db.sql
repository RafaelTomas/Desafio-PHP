CREATE DATABASE crud;

use crud;

CREATE TABLE usuario (
id_user integer PRIMARY KEY AUTO_INCREMENT,
login varchar(50) NOT NULL,
senha varchar(50) NOT NULL
);

CREATE TABLE atividade (
id_atividade integer PRIMARY KEY AUTO_INCREMENT,
nome varchar(200),
descricao varchar(300),
status ENUM ('pendente','concluida','cancelada'),
id_user integer,
CONSTRAINT fk_PesAtiv FOREIGN KEY (id_user) REFERENCES usuario (id_user)
);

INSERT INTO atividade(nome, descricao, status, data_ini, data_fim) VALUES ();

   public function create(){
        $query = 'INSERT INTO atividade(nome, descricao, status, data_ini, data_fim) VALUES (:nome, :descricao, :status, :data_ini, :data_fim)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }
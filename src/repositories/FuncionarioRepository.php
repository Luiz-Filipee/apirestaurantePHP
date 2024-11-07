<?php

class FuncionarioRepository {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function criaFuncionario(Funcionario $funcionario) {
        $query = "INSERT INTO funcionarios (nome, cargo, salario) VALUES (:nome, :cargo, :salario)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':nome', $funcionario->getNome());
        $stmt->bindValue(':cargo', $funcionario->getCargo());
        $stmt->bindValue(':salario', $funcionario->getSalario());
        
        if ($stmt->execute()) {
            $funcionario->setId($this->pdo->lastInsertId());
            return $funcionario;
        } else {
            throw new Exception("Erro ao salvar funcionário");
        }
    }

    public function buscaPorId($id) {
        $query = "SELECT * FROM funcionarios WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();

        return $result ? new Funcionario($result['id'], $result['nome'], $result['cargo'], $result['salario']) : null;
    }

    public function listar() {
        $query = "SELECT * FROM funcionarios";
        $stmt = $this->pdo->query($query);
        $results = $stmt->fetchAll();

        $funcionarios = [];
        foreach ($results as $row) {
            $funcionarios[] = new Funcionario($row['id'], $row['nome'], $row['cargo'], $row['salario']);
        }
        return $funcionarios;
    }

    public function atualiza(Funcionario $funcionario) {
        $query = "UPDATE funcionarios SET nome = :nome, cargo = :cargo, salario = :salario WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':nome', $funcionario->getNome());
        $stmt->bindValue(':cargo', $funcionario->getCargo());
        $stmt->bindValue(':salario', $funcionario->getSalario());
        $stmt->bindValue(':id', $funcionario->getId());

        return $stmt->execute();
    }

    public function remove($id) {
        $query = "DELETE FROM funcionarios WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }
}

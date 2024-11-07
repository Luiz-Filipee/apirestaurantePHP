<?php

require_once(__DIR__ . '/../config/db.php');

class ClienteRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function findById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM clientes WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvar($cliente){
        $stmt = $this->pdo->prepare('INSERT INTO clientes (nome, email) VALUES (?, ?, ?)');
        $stmt->execute([
            $cliente->getNome(),
            $cliente->getEmail(),
        ]);
        $cliente->setId($this->pdo->lastInsertId());
        return $cliente;
    }


    public function listar(){
        $stmt = $this->pdo->query('SELECT * FROM clientes');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

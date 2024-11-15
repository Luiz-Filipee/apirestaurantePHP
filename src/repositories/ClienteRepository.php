<?php

require_once(__DIR__ . '/../config/db.php');


class ClienteRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function findById($id){
        $stmt = $this->pdo->prepare('SELECT * FROM cliente WHERE id = ?');
        $stmt->execute([$id]);
        $clienteData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($clienteData) {
            return new Cliente($clienteData['id'], $clienteData['nome'], $clienteData['telefone']);
        }
    
        return null;
    }

    public function salvar($cliente){
        $stmt = $this->pdo->prepare('INSERT INTO cliente (nome, telefone) VALUES (:nome, :telefone)');
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':telefone', $cliente->getTelefone());
        $stmt->execute();
        $cliente->setId($this->pdo->lastInsertId());
        return $cliente;
    }


    public function listar(){
        $stmt = $this->pdo->query('SELECT * FROM cliente');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

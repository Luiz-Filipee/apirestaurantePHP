<?php

require_once '../config/db.php';

class MesaRepository
{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $stmt = $this->pdo->query('SELECT * FROM mesa');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($mesa){
        $stmt = $this->pdo->prepare(query: 'INSERT INTO mesa (nome, status ,id_cliente) VALUES (:nome, :status ,:id_cliente)');
        $stmt->bindValue(':nome', $mesa->getNome());
        $stmt->bindValue(':status', $mesa->getStatus());
        $clienteId = is_int($mesa->getCliente()) ? $mesa->getCliente() : $mesa->getCliente()->getId();
        $stmt->bindValue(':id_cliente', $clienteId);
        $stmt->execute();
        $mesa->setId($this->pdo->lastInsertId());
        return $mesa;
    }

    public function atualizarMesa(Mesa $mesa){
        $query = "UPDATE mesa SET nome = :nome, cliente_id = :cliente_id, status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':id', $mesa->getId());
        $stmt->bindValue(':nome', $mesa->getNome());
        $stmt->bindValue(':status', $mesa->getStatus());
        $stmt->bindValue(':cliente_id', $mesa->getCliente()->getId());

        $stmt->execute();
    }

    public function buscaPorId($id){
        $stmt = $this->pdo->prepare('SELECT * FROM mesa WHERE id = ?');
        $stmt->execute([$id]);
        $mesa = $stmt->fetch(PDO::FETCH_ASSOC);

        if($mesa){
            return $mesa;
        }else{
            return null;
        }
    }


    public function remove($id) {
        $query = "DELETE FROM mesa WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function findByClienteNome($nome){
        $stmt = $this->pdo->prepare('
            SELECT mesas.* FROM mesa
            JOIN clientes ON mesas.cliente_id = clientes.id 
            WHERE clientes.nome = ?
        ');
        $stmt->execute([$nome]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// $host = '192.168.100.86';
// $db = 'api_db';
// $user = 'root';
// $pass = 'password';
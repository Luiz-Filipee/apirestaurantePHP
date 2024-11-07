<?php

require_once 'Database.php';

class MesaRepository
{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $stmt = $this->pdo->query('SELECT * FROM mesas');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($mesa){
        $stmt = $this->pdo->prepare('INSERT INTO mesas (cliente_id) VALUES (:cliente_id)');
        $stmt->bindParam(':cliente_id', $mesa['cliente_id']);
        $stmt->execute();
        $mesa['id'] = $this->pdo->lastInsertId();
        return $mesa;
    }

    public function atualizarMesa(Mesa $mesa){
        $query = "UPDATE mesas SET numero = :numero, cliente_id = :cliente_id WHERE id = :id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':id', $mesa->getId());
        $stmt->bindParam(':numero', $mesa->getNumero());
        $stmt->bindParam(':cliente_id', $mesa->getCliente());

        $stmt->execute();
    }

    public function buscaPorId($id){
        $stmt = $this->pdo->prepare('SELECT * FROM mesas WHERE id = ?');
        $stmt->execute([$id]);
        $mesa = $stmt->fetchColumn(PDO::FETCH_ASSOC);

        if($mesa){
            echo "Mesa ID: " . $mesa['id'] . "\n";
            echo "Nome: " . $mesa['nome'] . "\n";
            echo "Capacidade: " . $mesa['capacidade'] . "\n";
            echo "Status: " . $mesa['status'] . "\n";
            return $mesa;
        }else{
            return null;
        }
    }

    public function removePorId($id){
        $stmt = $this->pdo->prepare('DELETE FROM mesas WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function findByClienteNome($nome){
        $stmt = $this->pdo->prepare('
            SELECT mesas.* FROM mesas 
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
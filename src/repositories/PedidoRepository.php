<?php
require_once '../repositories/MesaRepository.php';


class PedidoRepository {
    private $pdo;
    private $mesaRepository;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->mesaRepository = new MesaRepository();
    }

    public function salvar(Pedido $pedido)
    {
        $mesa = $pedido->getMesa();
        if ($mesa && is_object($mesa)) {
            $mesa_id = $mesa->getId();
        } else {
            $mesa = $this->mesaRepository->buscaPorId($pedido->getMesa()); 
            $mesa_id = $mesa ? $mesa->getId() : null;
        }
    
        $query = "INSERT INTO pedido (status, preco_total, id_mesa) 
                  VALUES (:status, :preco_total, :id_mesa)";
        $stmt = $this->pdo->prepare($query);
    
        $stmt->bindValue(':status', $pedido->getStatus());
        $stmt->bindValue(':preco_total', $pedido->getPrecoTotal());
        $stmt->bindValue(':id_mesa', $mesa_id);
    
        $stmt->execute();
        $pedido->setId($this->pdo->lastInsertId()); 
        return $pedido;
    }

    public function buscarPorId($id)
    {
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM pedido WHERE id = ?');
            $stmt->execute([$id]);
            $pedido = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($pedido) {
                return $pedido;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo 'Erro na consulta: ' . $e->getMessage();
            return null;
        }
    }

    public function atualizarStatus($id, $status)
    {
        try {
            $stmt = $this->pdo->prepare('UPDATE pedido SET status = ? WHERE id = ?');
            $stmt->execute([$status, $id]);
        } catch (PDOException $e) {
            throw new Exception("Erro ao atualizar o pedido: " . $e->getMessage());
        }
    }

    public function atualizar(Pedido $pedido)
    {
        $query = "UPDATE pedido SET status = :status, preco_total = :preco_total, funcionario_id = :funcionario_id, mesa_id = :mesa_id WHERE id = :id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':id', $pedido->getId());
        $stmt->bindParam(':status', $pedido->getStatus());
        $stmt->bindParam(':preco_total', $pedido->getPrecoTotal());
        $stmt->bindParam(':mesa_id', $pedido->getMesa() ? $pedido->getMesa()->getId() : null);

        $stmt->execute();
    }

    public function deletar($id)
    {
        $query = "DELETE FROM pedido WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function listar(){
        $stmt = $this->pdo->query('SELECT * FROM pedido');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
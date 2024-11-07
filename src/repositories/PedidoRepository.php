<?php
class PedidoRepository {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function salvar(Pedido $pedido)
    {
        $query = "INSERT INTO pedidos (status, preco_total, funcionario_id, mesa_id) VALUES (:status, :preco_total, :funcionario_id, :mesa_id)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':status', $pedido->getStatus());
        $stmt->bindParam(':preco_total', $pedido->getPrecoTotal());
        $stmt->bindParam(':funcionario_id', $pedido->getFuncionario() ? $pedido->getFuncionario()->getId() : null);
        $stmt->bindParam(':mesa_id', $pedido->getMesa() ? $pedido->getMesa()->getId() : null);

        $stmt->execute();
        $pedido->setId($this->pdo->lastInsertId()); 
        return $pedido;
    }

    public function buscarPorId($id)
    {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($dados) {
            $funcionario = new Funcionario(); 
            $mesa = new Mesa(); 
            return new Pedido($dados['id'], $dados['status'], $dados['preco_total'], $funcionario, $mesa);
        }

        return null;
    }

    public function atualizar(Pedido $pedido)
    {
        $query = "UPDATE pedidos SET status = :status, preco_total = :preco_total, funcionario_id = :funcionario_id, mesa_id = :mesa_id WHERE id = :id";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':id', $pedido->getId());
        $stmt->bindParam(':status', $pedido->getStatus());
        $stmt->bindParam(':preco_total', $pedido->getPrecoTotal());
        $stmt->bindParam(':funcionario_id', $pedido->getFuncionario() ? $pedido->getFuncionario()->getId() : null);
        $stmt->bindParam(':mesa_id', $pedido->getMesa() ? $pedido->getMesa()->getId() : null);

        $stmt->execute();
    }

    public function deletar($id)
    {
        $query = "DELETE FROM pedidos WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function listar()
    {
        $query = "SELECT * FROM pedidos";
        $stmt = $this->pdo->query($query);
        $pedidos = [];

        while ($dados = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $funcionario = new Funcionario();
            $mesa = new Mesa(); 
            $pedidos[] = new Pedido($dados['id'], $dados['status'], $dados['preco_total'], $funcionario, $mesa);
        }

        return $pedidos;
    }
}
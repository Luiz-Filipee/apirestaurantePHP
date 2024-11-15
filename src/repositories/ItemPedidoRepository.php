<?php

require_once '../models/ItemPedido.php';
require_once '../config/db.php';

class ItemPedidoRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function listar(){
        $stmt = $this->pdo->query('SELECT * FROM item_pedido');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvar(ItemPedido $itemPedido) {
        $stmt = $this->pdo->prepare('INSERT INTO item_pedido (descricao, quantidade, id_pedido) VALUES (:descricao, :quantidade, :id_pedido)');
        $stmt->bindValue(':descricao', $itemPedido->getDescricao());
        $stmt->bindValue(':quantidade', $itemPedido->getQuantidade());
        $stmt->bindValue(':id_pedido', $itemPedido->getPedidoId());
        $stmt->execute();
        $itemPedido->setId($this->pdo->lastInsertId());
        return $itemPedido;
    }

    public function buscarItensPorPedido($pedidoId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM item_pedido WHERE id_pedido = ?');
        $stmt->execute([$pedidoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM item_pedido WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizar(ItemPedido $itemPedido)
    {
        $stmt = $this->pdo->prepare('UPDATE item_pedido SET descricao = ?, quantidade = ?, id_pedido = ? WHERE id = ?');
        $stmt->execute([
            $itemPedido->getDescricao(),
            $itemPedido->getQuantidade(),
            $itemPedido->getPedidoId(),
            $itemPedido->getId()
        ]);
    }

    public function deletar($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM item_pedido WHERE id = ?');
        $stmt->execute([$id]);
    }
}

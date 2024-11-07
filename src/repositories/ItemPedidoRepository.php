<?php

require_once 'ItemPedido.php';
require_once 'Database.php';

class ItemPedidoRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function salvar(ItemPedido $itemPedido)
    {
        $stmt = $this->pdo->prepare('INSERT INTO item_pedido (descricao, quantidade, id_pedido) VALUES (?, ?, ?)');
        $stmt->execute([
            $itemPedido->getDescricao(),
            $itemPedido->getQuantidade(),
            $itemPedido->getPedidoId()
        ]);
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

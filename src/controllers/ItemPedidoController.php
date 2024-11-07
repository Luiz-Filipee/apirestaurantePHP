<?php

require_once 'ItemPedido.php';
require_once 'ItemPedidoRepository.php';

class ItemPedidoController
{
    private $itemPedidoRepository;

    public function __construct()
    {
        $this->itemPedidoRepository = new ItemPedidoRepository();
    }

    public function criar($descricao, $quantidade, $pedidoId)
    {
        $itemPedido = new ItemPedido($descricao, $quantidade, $pedidoId);
        return $this->itemPedidoRepository->salvar($itemPedido);
    }

    public function buscarItensPorPedido($pedidoId)
    {
        return $this->itemPedidoRepository->buscarItensPorPedido($pedidoId);
    }

    public function buscarPorId($id)
    {
        return $this->itemPedidoRepository->buscarPorId($id);
    }

    public function atualizar($id, $descricao, $quantidade, $pedidoId)
    {
        $itemPedido = new ItemPedido($descricao, $quantidade, $pedidoId);
        $itemPedido->setId($id);
        $this->itemPedidoRepository->atualizar($itemPedido);
        return $itemPedido;
    }

    public function deletar($id)
    {
        $this->itemPedidoRepository->deletar($id);
    }
}

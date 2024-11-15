<?php

require_once '../models/ItemPedido.php';
require_once '../repositories/ItemPedidoRepository.php';

class ItemPedidoController
{
    private $itemPedidoRepository;

    public function __construct()
    {
        $this->itemPedidoRepository = new ItemPedidoRepository();
    }

    public function listar(){
        $itensPedido = $this->itemPedidoRepository->listar();
        header('Content-Type: application/json');
        echo json_encode($itensPedido);
    }

    public function criar($data)
    {
        $descricao = $data['descricao'];
        $quantidade = $data['quantidade'];
        $pedidoId = $data['pedidoId'];
       
        $itemPedido = new ItemPedido(null, $descricao, $quantidade, $pedidoId);

        try {
            $itemPedidoSalvo = $this->itemPedidoRepository->salvar($itemPedido);
            http_response_code(201);
            echo json_encode($itemPedidoSalvo->toArray());
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar a item pedido']);
        }
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

<?php

require_once "../repositories/PedidoRepository.php";
require_once "../repositories/MesaRepository.php";
require_once '../models/Pedido.php';


class PedidoController {
    private $pedidoRepository;
    private $mesaRepository;

    public function __construct(){
        $this->pedidoRepository = new PedidoRepository();
        $this->mesaRepository = new MesaRepository();
    }

    public function criaPedido($data){
        // var_dump($data);

        // $mesaId = $data['id_mesa'] ?? null;
        // if (!$mesaId) {
        //     http_response_code(400);
        //     echo json_encode(['error' => 'ID da mesa é obrigatório']);
        //     return;
        // }
        
        // var_dump($mesaId); 

        // $mesa = $this->mesaRepository->buscaPorId($mesaId);
        // var_dump($mesa); 
        
        // if (!$mesa) {
        //     http_response_code(400);
        //     echo json_encode(['error' => 'Mesa não encontrada']);
        //     return;
        // }
        $status = $data['status'] ?? 'pendente';
        $precoTotal = $data['preco_total'] ?? 0;
    

        $pedido = new Pedido();
        $pedido->setMesa(null);
        $pedido->setStatus($status);
        $pedido->setPrecoTotal($precoTotal);

        try {
            $pedidoSalvo = $this->pedidoRepository->salvar($pedido);
            http_response_code(201);
            echo json_encode($pedidoSalvo->toArray());
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar o pedido', 'message' => $e->getMessage()]);
        }
    }

    public function marcarComoPronto($id) {
        error_log("Valor de ID recebido: " . var_export($id, true));
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("ID de pedido inválido.");
        }
        $pedido = $this->pedidoRepository->buscarPorId($id);
        if (!$pedido) {
            throw new Exception("Pedido não encontrado.");
        }
        $this->pedidoRepository->atualizarStatus($id, 'Pronto');
        echo json_encode(['message' => 'Pedido atualizado com sucesso', 'pedido' => ['id' => $id, 'status' => 'Pronto']]);
    }
    
    

    

    public function atualizarPedido($id, $data){
        $pedido = $this->pedidoRepository->buscarPorId($id);
        if ($pedido) {
            if(isset($data['status'])){
                $pedido->setStatus($data['status']);
            }
            if(isset($data['mesa'])){
                $pedido->setMesa($data['mesa']);
            }
            if(isset($data['precoTotal'])){
                $pedido->setPrecoTotal($data['precoTotal']);
            }
            $this->pedidoRepository->atualizar($pedido);
            echo "Pedido atualizado com sucesso!";
        } else {
            echo "Pedido não encontrado!";
        }
    }

    public function deletarPedido($id)
    {
        try {
            if ($this->pedidoRepository->deletar($id)) {
                http_response_code(204);
                echo json_encode(['message' => 'Pedido removido com sucesso']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Pedido não encontrado']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao deletar pedido', 'message' => $e->getMessage()]);
        }
    }

    public function listarPedidos()
    {
        $pedidos = $this->pedidoRepository->listar();
        header('Content-Type: application/json');
        echo json_encode($pedidos);
    }

    public function visualizarPedido($id)
    {
        $pedido = $this->pedidoRepository->buscarPorId($id);
        if ($pedido) {
            echo "Pedido ID: " . $pedido->getId() . " - Status: " . $pedido->getStatus() . " - Preço Total: " . $pedido->getPrecoTotal();
        } else {
            echo "Pedido não encontrado!";
        }
    }
}

<?php
class PedidoController {
    private $pedidoRepository;
    private $mesaRepository;
    private $funcionarioRepository;

    public function __construct(
        PedidoRepository $pedidoRepository, 
        MesaRepository $mesaRepository,
        FuncionarioRepository $funcionarioRepository){
        $this->pedidoRepository = $pedidoRepository;
        $this->mesaRepository = $mesaRepository;
        $this->funcionarioRepository = $funcionarioRepository;

    }

    public function criaPedido($data){
        $mesaId = $data['mesa_id'];
        $funcionarioId = $data['funcionario_id'];
        $status = $data['status'] ?? 'pendente';
        $precoTotal = $data['preco_total'] ?? 0;
            
        $mesa = $this->mesaRepository->buscaPorId($mesaId);
        if (!$mesa) {
            http_response_code(400);
            echo json_encode(['error' => 'Mesa não encontrada']);
            return;
        }

        $funcionario = $this->funcionarioRepository->buscaPorId($funcionarioId);
        if (!$funcionario) {
            http_response_code(400);
            echo json_encode(['error' => 'Funcionário não encontrado']);
            return;
        }

        $pedido = new Pedido();
        $pedido->setMesa($mesa);
        $pedido->setFuncionario($funcionario);
        $pedido->setStatus($status);
        $pedido->setPrecoTotal($precoTotal);

        try {
            $pedidoSalvo = $this->pedidoRepository->salvar($pedido);
            http_response_code(201);
            echo json_encode($pedidoSalvo->toArray());
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar o pedido']);
        }
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
            if(isset($data['funcionario'])){
                $pedido->setFuncionario($data['funcionario']);
            }
            $this->pedidoRepository->atualizar($pedido);
            echo "Pedido atualizado com sucesso!";
        } else {
            echo "Pedido não encontrado!";
        }
    }

    public function deletarPedido($id)
    {
        $this->pedidoRepository->deletar($id);
        echo "Pedido deletado com sucesso!";
    }

    public function listarPedidos()
    {
        $pedidos = $this->pedidoRepository->listar();
        foreach ($pedidos as $pedido) {
            echo "Pedido ID: " . $pedido->getId() . " - Status: " . $pedido->getStatus() . " - Preço Total: " . $pedido->getPrecoTotal() . "<br>";
        }
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
?>

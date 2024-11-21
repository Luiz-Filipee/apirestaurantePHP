<?php 
require_once '../app/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once '../controllers/PedidoController.php';

class PedidoControllerTest extends TestCase{
    private $pedidoController;

    public function setUp(): void{
        $this->pedidoController = new PedidoController();
    }

    public function testCriaPedido()
    {
        $data = [
            'status' => 'pendente',
            'preco_total' => 100.00
        ];

        ob_start(); // Inicia a captura de saída
        $this->pedidoController->criaPedido($data);
        $output = ob_get_clean(); // Captura o conteúdo da saída

        $this->assertNotEmpty($output, "A resposta do método criaPedido não pode ser vazia.");
        $this->assertJson($output, "A resposta do método criaPedido deve ser um JSON.");
    }

    public function testMarcarComoPronto()
    {
        $id = 1; 

        ob_start();
        $this->pedidoController->marcarComoPronto($id);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método marcarComoPronto não pode ser vazia.");
        $this->assertJson($output, "A resposta do método marcarComoPronto deve ser um JSON.");
        $this->assertStringContainsString('Pronto', $output, "O status do pedido não foi alterado para 'Pronto'.");
    }

    public function testAtualizarPedido()
    {
        $id = 1;
        $data = [
            'status' => 'em andamento',
            'mesa' => 5,
            'precoTotal' => 150.00
        ];

        ob_start();
        $this->pedidoController->atualizarPedido($id, $data);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método atualizarPedido não pode ser vazia.");
        $this->assertStringContainsString('Pedido atualizado com sucesso!', $output, "A resposta não contém a mensagem de sucesso.");
    }

    public function testDeletarPedido()
    {
        $id = 1; 

        ob_start();
        $this->pedidoController->deletarPedido($id);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método deletarPedido não pode ser vazia.");
        $this->assertJson($output, "A resposta do método deletarPedido deve ser um JSON.");
        $this->assertStringContainsString('Pedido removido com sucesso', $output, "A resposta não contém a mensagem de sucesso.");
    }

    public function testListarPedidos()
    {
        ob_start();
        $this->pedidoController->listarPedidos();
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método listarPedidos não pode ser vazia.");
        $this->assertJson($output, "A resposta do método listarPedidos deve ser um JSON.");
    }

    public function testVisualizarPedido()
    {
        $id = 1;

        ob_start();
        $this->pedidoController->visualizarPedido($id);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método visualizarPedido não pode ser vazia.");
        $this->assertStringContainsString('Pedido ID:', $output, "A resposta não contém a mensagem com o ID do pedido.");
    }
}
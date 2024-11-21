<?php
require_once '../controllers/ItemPedidoController.php';
require_once '../repositories/ItemPedidoRepository.php';
require_once '../models/ItemPedido.php';

use PHPUnit\Framework\TestCase;

class ItemPedidoControllerTest extends TestCase
{
    private $itemPedidoController;

    public function setUp(): void
    {
        $this->itemPedidoController = new ItemPedidoController();
    }

    public function testListar()
    {
        ob_start();
        $this->itemPedidoController->listar();
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método listar não pode ser vazia.");
        $this->assertJson($output, "A resposta do método listar deve ser um JSON.");
    }

    public function testCriar()
    {
        $data = [
            'descricao' => 'Item Teste',
            'quantidade' => 2,
            'pedidoId' => 1
        ];

        ob_start();
        $this->itemPedidoController->criar($data);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método criar não pode ser vazia.");
        $this->assertJson($output, "A resposta do método criar deve ser um JSON.");
    }

    public function testBuscarItensPorPedido()
    {
        $pedidoId = 1; 

        ob_start();
        $itens = $this->itemPedidoController->buscarItensPorPedido($pedidoId);
        echo json_encode($itens);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método buscarItensPorPedido não pode ser vazia.");
        $this->assertJson($output, "A resposta do método buscarItensPorPedido deve ser um JSON.");
    }

    public function testAtualizar()
    {
        $id = 1; 
        $descricao = 'Item Atualizado';
        $quantidade = 3;
        $pedidoId = 1; 

        ob_start();
        $this->itemPedidoController->atualizar($id, $descricao, $quantidade, $pedidoId);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método atualizar não pode ser vazia.");
        $this->assertStringContainsString('Item atualizado com sucesso', $output, "A resposta não contém a mensagem de sucesso.");
    }

    public function testDeletar()
    {
        $id = 1; 

        ob_start();
        $this->itemPedidoController->deletar($id);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta do método deletar não pode ser vazia.");
        $this->assertJson($output, "A resposta do método deletar deve ser um JSON.");
    }
}

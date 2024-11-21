<?php 
require_once '../app/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once '../controllers/ClienteController.php';

class ClienteControllerTest extends TestCase{
    private $clienteController;

    public function setUp(): void{
        $this->clienteController = new ClienteController();
    }
    

    public function testListarClientes(){
        ob_start();
        $this->clienteController->listarClientes();
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "O output de listarClientes não deve ser vazio.");
        $this->assertJson($output, "O output de listarClientes deve estar em JSON.");
    }

    public function testCriaClienteComDadosValidos(){
        $dados = [ 
            'nome' => 'Cliente Teste',
            'telefone' => '6799834234'
        ];

        ob_start();
        $this->clienteController->criar($dados);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "O output de criaCliente não deve ser vazio.");
        $this->assertJson($output, "O output de criaCliente deve estar em JSON.");
    }

    public function testeCriaClienteComDadosInvalidos(){
        $dadosIncompletos = [
            'nome' => ' ',
            'status' => 'disponivel'
        ];

        ob_start();
        $this->clienteController->criar($dadosIncompletos);
        $output = ob_get_clean();

        $this->assertStringContainsString('Os campos nome, telefone são obrigatórios.', $output);
    }
}
?>
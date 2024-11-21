<?php 
require_once '../app/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once '../controllers/MesaController.php';
require_once '../repositories/ClienteRepository.php';
require_once '../repositories/MesaRepository.php';

class MesaControllerTest extends TestCase{

    private $mesaController;

    protected function setUp(): void
    {
        $this->mesaController = new MesaController();
    }

    public function testGetAllMesas()
    {
        ob_start(); // Comeca a captura de saida, armazena em buffer (memoria) qualquer saida que seria enviada para o navegador
        $this->mesaController->getAllMesas();
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "O output de getAllMesas não deve ser vazio.");
        $this->assertJson($output, "O output de getAllMesas deve estar em JSON.");
    }

    public function testCriaMesaComDadosValidos()
    {
        $dados = [
            'cliente_id' => 1,
            'nome' => 'Mesa Teste',
            'status' => 'disponivel'
        ];

        ob_start();
        $this->mesaController->criaMesa($dados);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "O output de criaMesa não deve ser vazio.");
        $this->assertJson($output, "O output de criaMesa deve estar em JSON.");
    }

    public function testCriaMesaComDadosInvalidos()
    {
        $dadosIncompletos = [
            'cliente_id' => '', 
            'nome' => 'Mesa Invalida',
            'status' => 'disponivel'
        ];

        ob_start();
        $this->mesaController->criaMesa($dadosIncompletos);
        $output = ob_get_clean();

        $this->assertStringContainsString('Os campos cliente_id, nome e status são obrigatórios.', $output);
    }

    public function testDeletaMesaExistente()
    {
        ob_start();
        $this->mesaController->remove(1); 
        $output = ob_get_clean();

        $this->assertEmpty($output, "O output de deletaMesa deve ser vazio quando bem-sucedido.");
    }

    public function testDeletaMesaNaoExistente()
    {
        ob_start();
        $this->mesaController->remove(999); 
        $output = ob_get_clean();

        $this->assertStringContainsString('Mesa não encontrada', $output);
    }

    public function testAtualizaMesaComDadosValidos()
    {
        $dadosAtualizados = [
            'nome' => 'Mesa Atualizada',
            'status' => 'ocupada'
        ];

        ob_start();
        $this->mesaController->atualizaMesa(1, $dadosAtualizados); 
        $output = ob_get_clean();

        $this->assertStringContainsString('Mesa atualizada com sucesso!', $output);
    }

    public function testBuscaMesaPeloNomeDoResponsavel()
    {
        ob_start();
        $this->mesaController->buscaMesaPeloNomeDoResponsavel('Cliente Teste'); 
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "O output de buscaMesaPeloNomeDoResponsavel não deve ser vazio.");
        $this->assertJson($output, "O output de buscaMesaPeloNomeDoResponsavel deve estar em JSON.");
    }
}
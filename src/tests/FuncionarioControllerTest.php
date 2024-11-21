<?php 
require_once '../app/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
class FuncionarioControllerTest extends TestCase{
    private $funcionarioController;

    public function setUp(): void{
        $this->funcionarioController = new FuncionarioRepository();
    }

    public function testCriaFuncionario() {
        $dados = [
            'nome' => 'Carlos Silva',
            'cargo' => 'Desenvolvedor',
            'salario' => 5000
        ];

        ob_start();
        $this->funcionarioController->criaFuncionario($dados);
        $output = ob_get_clean();
        
        $this->assertNotEmpty($output, "A resposta de criaFuncionario não pode ser vazia.");
        $this->assertJson($output, "A resposta de criaFuncionario deve ser um JSON.");
        $this->assertStringContainsString('Carlos Silva', $output, "O nome do funcionário não foi encontrado na resposta.");
    }

    public function testAtualizaFuncionario() {
        $id = 1;
        $dados = [
            'nome' => 'Carlos Silva',
            'cargo' => 'Gerente',
            'salario' => 6000
        ];

        ob_start();
        $this->funcionarioController->atualizaFuncionario($id, $dados);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta de atualizaFuncionario não pode ser vazia.");
        $this->assertJson($output, "A resposta de atualizaFuncionario deve ser um JSON.");
        $this->assertStringContainsString('Funcionario atualizado com sucesso', $output, "A resposta não contém mensagem de sucesso.");
    }

    public function testListaFuncionarios() {
        ob_start();
        $this->funcionarioController->listaFuncionarios();
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta de listaFuncionarios não pode ser vazia.");
        $this->assertJson($output, "A resposta de listaFuncionarios deve ser um JSON.");
    }

    public function testExcluiFuncionario() {
        $id = 1;

        ob_start();
        $this->funcionarioController->excluiFuncionario($id);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta de excluiFuncionario não pode ser vazia.");
        $this->assertJson($output, "A resposta de excluiFuncionario deve ser um JSON.");
        $this->assertStringContainsString('Funcionário deletado com sucesso', $output, "A resposta não contém mensagem de sucesso.");
    }

    public function testBuscaFuncionarioPorNome() {
        $nome = 'Carlos Silva';

        ob_start();
        $this->funcionarioController->buscaFuncionarioPorNome($nome);
        $output = ob_get_clean();

        $this->assertNotEmpty($output, "A resposta de buscaFuncionarioPorNome não pode ser vazia.");
        $this->assertJson($output, "A resposta de buscaFuncionarioPorNome deve ser um JSON.");
        $this->assertStringContainsString('Carlos Silva', $output, "O nome do funcionário não foi encontrado na resposta.");
    }
}
?>
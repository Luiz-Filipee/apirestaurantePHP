<?php
require_once '../models/Funcionario.php';
require_once '../repositories/FuncionarioRepository.php';

class FuncionarioController {
    private $funcionarioRepository;

    public function __construct() {
        $this->funcionarioRepository = new FuncionarioRepository();
    }

    public function criaFuncionario($data) {
        try {
            $funcionario = new Funcionario(null, $data['nome'], $data['cargo'], $data['salario']);
            $funcionarioSalvo = $this->funcionarioRepository->criaFuncionario($funcionario);
            http_response_code(201);
            echo json_encode($funcionarioSalvo->toArray());
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar funcionário']);
        }
    }

    public function atualizaFuncionario($id, $data) {
        $funcionario = $this->funcionarioRepository->buscaPorId($id);
        if (!$funcionario) {
            http_response_code(404);
            echo json_encode(['error' => 'Funcionário não encontrado']);
            return;
        }

        $funcionario->setNome($data['nome']);
        $funcionario->setCargo($data['cargo']);
        $funcionario->setSalario($data['salario']);

        try {
            $this->funcionarioRepository->atualiza($funcionario);
            echo json_encode(['message' => 'Funcionário atualizado com sucesso']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar funcionário']);
        }
    }

    public function listaFuncionarios() {
        $funcionarios = $this->funcionarioRepository->listar();
        echo json_encode(array_map(function ($funcionario) {
            return $funcionario->toArray();
        }, $funcionarios));
    }

    public function excluiFuncionario($id) {
        $funcionario = $this->funcionarioRepository->buscaPorId($id);
        if (!$funcionario) {
            http_response_code(404);
            echo json_encode(['error' => 'Funcionário não encontrado']);
            return;
        }

        try {
            $this->funcionarioRepository->remove($id);
            echo json_encode(['message' => 'Funcionário deletado com sucesso']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao deletar funcionário']);
        }
    }

    public function buscaFuncionarioPorNome($nome){
        $funcionarioEncontrado = $this->funcionarioRepository->buscaPorNome($nome);
    
        header('Content-Type: application/json');
        if($funcionarioEncontrado){
            echo json_encode($funcionarioEncontrado);
        } else {
            echo json_encode(['error' => 'Funcionário não encontrado']);
        }
    }
}

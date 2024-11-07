<?php

class FuncionarioController {
    private $funcionarioRepository;

    public function __construct($funcionarioRepository) {
        $this->funcionarioRepository = $funcionarioRepository;
    }

    public function criaFuncionario($data) {
        try {
            $funcionario = new Funcionario(null, $data['nome'], $data['cargo'], $data['salario']);
            $funcionarioSalvo = $this->funcionarioRepository->save($funcionario);
            http_response_code(201);
            echo json_encode($funcionarioSalvo->toArray());
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar funcionário']);
        }
    }

    public function atualizaFuncionario($id, $data) {
        $funcionario = $this->funcionarioRepository->findById($id);
        if (!$funcionario) {
            http_response_code(404);
            echo json_encode(['error' => 'Funcionário não encontrado']);
            return;
        }

        $funcionario->setNome($data['nome']);
        $funcionario->setCargo($data['cargo']);
        $funcionario->setSalario($data['salario']);

        try {
            $this->funcionarioRepository->update($funcionario);
            echo json_encode(['message' => 'Funcionário atualizado com sucesso']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao atualizar funcionário']);
        }
    }

    public function listaFuncionarios() {
        $funcionarios = $this->funcionarioRepository->findAll();
        echo json_encode(array_map(function ($funcionario) {
            return $funcionario->toArray();
        }, $funcionarios));
    }

    public function excluiFuncionario($id) {
        $funcionario = $this->funcionarioRepository->findById($id);
        if (!$funcionario) {
            http_response_code(404);
            echo json_encode(['error' => 'Funcionário não encontrado']);
            return;
        }

        try {
            $this->funcionarioRepository->delete($id);
            echo json_encode(['message' => 'Funcionário deletado com sucesso']);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao deletar funcionário']);
        }
    }
}

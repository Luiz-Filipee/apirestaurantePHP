<?php

require_once '../repositories/ClienteRepository.php';
require_once '../repositories/MesaRepository.php';
require_once '../models/Mesa.php';
require_once '../models/Cliente.php';


class MesaController
{
    private $mesaRepository;
    private $clienteRepository;

    public function __construct()
    {
        $this->mesaRepository = new MesaRepository();
        $this->clienteRepository = new ClienteRepository();
    }


    public function getAllMesas()
    {
        $mesas = $this->mesaRepository->listar();
        header('Content-Type: application/json');
        echo json_encode($mesas);
    }

    public function criaMesa($data)
    {
        if (empty($data['cliente_id']) || empty($data['nome']) || empty($data['status'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Os campos cliente_id, nome e status são obrigatórios.']);
            return;
        }

        $clienteId = $data['cliente_id'];
        $nome = $data['nome'];
        $status = $data['status'];
        
        
        $cliente = $this->clienteRepository->findById($clienteId);
        if (!$cliente) {
            http_response_code(400);
            echo json_encode(['error' => 'Cliente não encontrado']);
            return;
        }

        $mesa = new Mesa(null, $nome, $status, $clienteId);

        try {
            $mesaSalva = $this->mesaRepository->save($mesa);
        
            if ($mesaSalva instanceof Mesa) {
                http_response_code(201);
                echo json_encode($mesaSalva->toArray());
            } else {
                throw new Exception("Erro ao salvar a mesa: Retorno inválido.");
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar a mesa', 'message' => $e->getMessage()]);
        }
    }

   

    public function remove($id){
        try {
            if ($this->mesaRepository->remove($id)) {
                http_response_code(204);
                echo json_encode(['message' => 'Mesa removida com sucesso']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Mesa não encontrada']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao deletar mesa', 'message' => $e->getMessage()]);
        }
    }

    public function buscaPorId($id){
        $mesaEncontrado = $this->mesaRepository->buscaPorId($id);
        if($mesaEncontrado){
            return $mesaEncontrado;
        }else{
            return null;
        }
    }

    public function atualizaMesa($id, $data)
    {
        $mesa = $this->mesaRepository->buscaPorId($id);
        if ($mesa) {
            if (isset($data['nome'])) {
                $mesa->setNome($data['nome']);
            }
            if (isset($data['cliente'])) {
                $mesa->setCliente($data['cliente']);
            }
            if (isset($data['status'])) {
                $mesa->setStatus($data['status']);
            }

            // Atualiza no banco de dados
            try {
                $mesaAtualizada = $this->mesaRepository->save($mesa);
                http_response_code(200);
                echo json_encode([
                    'message' => 'Mesa atualizada com sucesso!',
                    'mesa' => $mesaAtualizada->toArray()
                ]);
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode(['error' => 'Erro ao atualizar a mesa']);
            }
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Mesa não encontrada']);
        }
    }


    public function buscaMesaPeloNomeDoResponsavel($nome)
    {
        $mesas = $this->mesaRepository->findByClienteNome($nome);
        if (!empty($mesas)) {
            http_response_code(200);
            echo json_encode($mesas);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Mesa não encontrada']);
        }
    }
}

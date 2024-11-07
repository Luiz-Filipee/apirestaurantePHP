<?php

require_once 'ClienteRepository.php';
require_once 'MesaRepository.php';

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
        $clienteId = $data['cliente_id'];
        
        $cliente = $this->clienteRepository->findById($clienteId);
        if (!$cliente) {
            http_response_code(400);
            echo json_encode(['error' => 'Cliente não encontrado']);
            return;
        }

        $mesa = [
            'cliente_id' => $clienteId,
        ];

        try {
            $mesaSalva = $this->mesaRepository->save($mesa);
            http_response_code(201);
            echo json_encode($mesaSalva);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar a mesa']);
        }
    }

    public function deletaMesa($id)
    {
        try {
            if ($this->mesaRepository->buscaPorId($id)) {
                $this->mesaRepository->removePorId($id);
                http_response_code(204);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Mesa não encontrada']);
            }
        } catch (Exception $e) {
            http_response_code(409);
            echo json_encode(['error' => 'Erro de integridade: não é possível deletar a mesa porque ela está associada a outros registros']);
        }
    }

    public function atualizaMesa($id, $data){
        $mesa = $this->mesaRepository->buscaPorId($id);
        if ($mesa) {
            if(isset($data['numero'])){
                $mesa->setNumero($data['numero']);
            }
            if(isset($data['cliente'])){
                $mesa->setCliente($data['cliente']);
            }
            echo "Mesa atualizado com sucesso!";
        } else {
            echo "Mesa não encontrado!";
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

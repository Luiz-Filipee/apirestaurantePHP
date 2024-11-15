<?php 

require_once '../models/Cliente.php';
require_once '../repositories/ClienteRepository.php';

class ClienteController{
    private $clienteRepository;

    public function __construct()
    {
        $this->clienteRepository = new ClienteRepository();
    }


    public function criar($data){
        $nome = $data['nome'];
        $telefone = $data['telefone'];

        $cliente = new Cliente();
        $cliente->setNome($nome);
        $cliente->setTelefone($telefone);

        try {
            $clienteSalvo = $this->clienteRepository->salvar($cliente);
            http_response_code(201);
            echo json_encode($clienteSalvo->toArray());
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Erro ao salvar a mesa']);
        }
    }

    public function listarClientes(){
        $clientes = $this->clienteRepository->listar();
        header('Content-Type: application/json');
        echo json_encode($clientes);
    }
}

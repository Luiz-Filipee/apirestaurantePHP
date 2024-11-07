<?php 

require_once 'Cliente.php';
require_once 'ClienteRepository.php';

class ClienteController{
    private $clienteRepository;

    public function __construct()
    {
        $this->clienteRepository = new ClienteRepository();
    }


    public function criar($nome, $email)
    {
        $cliente = new Cliente($nome, $email);
        return $this->clienteRepository->salvar($cliente);
    }

    public function list(){
        return $this->clienteRepository->listar();
    }
}

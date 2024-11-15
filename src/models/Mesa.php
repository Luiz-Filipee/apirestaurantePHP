<?php

require_once 'Cliente.php';

class Mesa
{
    private $id;
    private $nome;
    private $status;
    private $cliente;

    public function __construct($id = null, $nome = null, $status = null ,$cliente = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
        $this->cliente = $cliente;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'status' => $this->status,
            // 'cliente' => $this->cliente ? $this->cliente->toArray() : null
        ];
    }
}

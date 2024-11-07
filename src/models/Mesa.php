<?php

require_once 'Cliente.php';

class Mesa
{
    private $id;
    private $numero;
    private $cliente;

    public function __construct($id = null, $numero = null, $cliente = null)
    {
        $this->id = $id;
        $this->numero = $numero;
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

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
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
            'numero' => $this->numero,
            'cliente' => $this->cliente ? $this->cliente->toArray() : null
        ];
    }
}

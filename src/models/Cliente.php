<?php

class Cliente
{
    private $id;
    private $nome;
    private $telefone;

    public function __construct($id = null, $nome = null, $telefone = null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->telefone = $telefone;
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

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'telefone' => $this->telefone
        ];
    }
}

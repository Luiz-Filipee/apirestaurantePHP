<?php

class ItemPedido
{
    private $id;
    private $descricao;
    private $quantidade;
    private $pedidoId; 

    public function __construct($id=null, $descricao = null, $quantidade = null, $pedidoId = null)
    {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
        $this->pedidoId = $pedidoId;
    }

    // Getters e Setters

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getPedidoId()
    {
        return $this->pedidoId;
    }

    public function setPedidoId($pedidoId)
    {
        $this->pedidoId = $pedidoId;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
            'quantidade' => $this->quantidade
        ];
    }
   
}

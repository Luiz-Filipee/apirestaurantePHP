<?php 
class Pedido{
    private $id;
    private $status;
    private $precoTotal;
    private $funcionario;
    private $mesa;

    public function __construct($id = null, $status = null, $precoTotal = null, $funcionario = null, $mesa = null)
    {
        $this->id = $id;
        $this->status = $status;
        $this->precoTotal = $precoTotal;
        $this->funcionario = $funcionario;
        $this->mesa = $mesa;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getPrecoTotal()
    {
        return $this->precoTotal;
    }

    public function setPrecoTotal($precoTotal)
    {
        $this->precoTotal = $precoTotal;
    }

    public function getFuncionario()
    {
        return $this->funcionario;
    }

    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;
    }

    public function getMesa()
    {
        return $this->mesa;
    }

    public function setMesa($mesa)
    {
        $this->mesa = $mesa;
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'preco total' => $this->precoTotal,
            'funcionario' => $this->funcionario ? $this->funcionario->toArray() : null,
            'mesa' => $this->mesa ? $this->mesa->toArray() : null
        ];
    }
}

<?php

class Conta{
    public int $id;
    public string $descricao;
    public float $valor;
    public function __construct(int $id,String $descricao,float $valor){
        $this->id = $id;
        $this->descricao = $descricao;
        $this->valor = $valor;
    }
}

?>
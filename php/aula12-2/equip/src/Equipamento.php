<?php
require_once 'Categoria.php';
class Equipamento{
    public int $id;
    public string $descricao;
    public string $codigo;
    public string $situacao;
    public DateTime $cadastro;
    public Categoria $categoria;

    public function __construct(int $id = 0 , string $descricao,string $codigo,string $situacao,DateTime $cadastro, Categoria $categoria){
        $this->id = $id;
        $this->descricao = $descricao;
        $this->codigo = $codigo;
        $this->situacao = $situacao;
        $this->cadastro = $cadastro;
        $this->categoria = $categoria;
    }
}

?>
<?php
require_once 'Categoria.php';
class RepositorioCategoriaEmBDR{
    public function __construct(private PDO $pdo){
    }

    public function adicionar(Categoria &$c){
        $sql = 'INSERT INTO categoria(descricao) VALUES (:descricao)';
        $ps = $this->pdo->prepare($sql);
        $ps->execute(['descricao'=>$c->descricao]);
        $c = $this->pdo->lastInsertId();
    }

    public function categoriaComId(int $id) : ?Categoria{
        $sql = 'SELECT * FROM categoria WHERE id=:id';
        $ps = $this->pdo->prepare($sql);    
        $ps->execute(['id'=>$id]);
        if ($ps->rowCount() < 1) {
            return null;
        }
        $ps = $ps->fetch();
        $cat = new Categoria($ps['id'],$ps['descricao']);
        return $cat;
    }

    public function listar() : array{
        $sql = 'SELECT * FROM categoria';
        $ps = $this->pdo->prepare($sql);
        $ps->execute();
        $categorias =[];
        foreach($ps as $c){
            $categorias[] = new Categoria($c['id'], $c['descricao']);
        }
        return $categorias;
    }
}

?>
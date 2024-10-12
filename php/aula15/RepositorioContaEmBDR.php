<?php
require_once './Conta.php';
class RepositorioContaEmBDR{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function adicionar(Conta &$c){
        $ps = $this->pdo->prepare("INSERT INTO contas(descricao,valor) VALUES (:descricao,:valor)");
        $ps->execute(["descricao"=>$c->descricao,"valor"=>$c->valor]);
        $c->id = $this->pdo->lastInsertId();
    }

    public function deletar(int $id) : bool{
        $ps = $this->pdo->prepare("DELETE FROM contas WHERE id=?");
        $ps->execute([$id]);
        return $ps->rowCount() > 0;
    }

    public function alterar(Conta $c){
        $ps = $this->pdo->prepare("UPDATE contas SET descricao=:descricao, valor=:valor WHERE id=:id");
        $ps->execute(["id"=>$c->id, "descricao"=>$c->descricao,"valor"=>$c->valor]);
    }

    public function listarTodos() : array{
        $ps = $this->pdo->prepare("SELECT * FROM contas");
        $ps->execute();
        $contas = [];
        foreach($ps as $r){
            $c = new Conta($r['id'],$r['descricao'], $r['valor']);
            array_push($contas, $c);
        }
        return $contas;
    }

    public function obterPeloId(int $id) : Conta{
        $ps = $this->pdo->prepare('SELECT * FROM contas WHERE id=?');
        $ps->execute([$id]);
        $c = null;
        foreach($ps as $r){
            $c = new Conta($r['id'],$r['descricao'],$r['valor']);
        }
        return $c;
    }
}

?>
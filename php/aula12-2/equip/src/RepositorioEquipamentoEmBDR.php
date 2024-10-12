<?php
require_once 'Categoria.php';
require_once 'Equipamento.php';
require_once 'RepositorioCategoriaEmBDR.php';
class RepositorioEquipamentoEmBDR{
    private PDO $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function adicionar(Equipamento &$e) : void{
        $sql = 'INSERT INTO equipamento(codigo,descricao,situacao,categoria_id,cadastro) VALUES (:codigo,:descricao,:situacao,:cat,:cadastro)';
        $ps = $this->pdo->prepare($sql);
        $data = $e->cadastro->format('Y-m-d H:i:s');
        $ps->execute(['codigo'=>$e->codigo,'descricao'=>$e->descricao,'situacao'=>$e->situacao,'cat'=>$e->categoria->id,'cadastro'=>$data]);
        $e->id = $this->pdo->lastInsertId();
    }
    public function excluirPeloId($id) : bool{
        $sql = 'DELETE FROM equipamento WHERE id=:id';
        $ps= $this->pdo->prepare($sql);
        $ps->execute(['id'=>$id]);
        return $ps->rowCount() > 0;
    }

    public function equipamentos() : array{
        $sql = <<<'SQL'
        SELECT e.id, codigo, e.descricao, situacao, cadastro, categoria_id, c.descricao as 'descricao_categoria'
        FROM equipamento e
        JOIN categoria c
        ON c.id=e.categoria_id
        SQL;
        $ps = $this->pdo->prepare($sql);
        $ps->setFetchMode(PDO::FETCH_ASSOC);
        $ps->execute();
        $equipamentos = [];
        foreach($ps as $r){
            $c = new Categoria($r['categoria_id'],$r['descricao_categoria']);
            $e = new Equipamento($r['id'],$r['descricao'],$r['codigo'],$r['situacao'],new DateTime($r['cadastro']),$c);
            $equipamentos[] = $e;
        }
        return $equipamentos;
    }

    public function equipamentoComId(int $id) : ?Equipamento{
        $sql = 'SELECT * FROM equipamento WHERE id=:id';
        $ps = $this->pdo->prepare($sql);
        $ps->execute(['id'=>$id]);
        $equipamento = null;
        if($ps->rowCount() > 0){
            $ps = $ps->fetch();
            $repocat = new RepositorioCategoriaEmBDR($this->pdo);
            $cat = $repocat->categoriaComId($ps['categoria_id']);
            $equipamento = new Equipamento($ps['id'],$ps['descricao'],$ps['codigo'],$ps['situacao'],new DateTime($ps['cadastro']),$cat);
        }
        return $equipamento;
    }
}
?>
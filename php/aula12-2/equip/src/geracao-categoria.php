<?php
require_once './src/Categoria.php';
require_once './src/RepositorioCategoriaEmBDR.php';
require_once 'conectar.php';


function desenharCategorias($categorias,$id = 0){
    $pdo = null;
    $categorias = null;
    try{
        $pdo = conectar();
        $repo = new RepositorioCategoriaEmBDR($pdo);
        $categorias = $repo->listar();
    }catch(PDOException $e){
        http_response_code(500);
        die('ERRO DE SERVIDOR');
    }
    foreach($categorias as $c){
        if($id > 0 && $c->id === $id){
            $linha = <<<HTML
            <option value="$c->id" selected>$c->descricao</option>
            HTML;
        }else{
            $linha = <<<HTML
            <option value="$c->id">$c->descricao</option>
            HTML;
        }
        echo $linha;
    }
}
?>
<?php
require_once './src/Categoria.php';
require_once './src/RepositorioCategoriaEmBDR.php';
require_once './conectar.php';
$descricao = $_POST['descricao'];
$pdo = null;
try{
    $pdo = conectar();
    $repo = new RepositorioCategoriaEmBDR($pdo);
    $c = new Categoria(0, $descricao);
    $repo->adicionar($c);
    header('Location : http://localhost/aula12/equip/listagem.php');
    http_response_code(200);
}catch(PDOException $e){
    http_response_code(500);
    die('ERRO DO SERVIDOR');
}


?>
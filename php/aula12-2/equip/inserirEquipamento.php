<?php
require_once './src/RepositorioEquipamentoEmBDR.php';
require_once 'conectar.php';
require_once './src/Equipamento.php';
require_once './src/RepositorioCategoriaEmBDR.php';
$pdo = null;
try{
    $pdo = conectar();
    $repo = new RepositorioEquipamentoEmBDR($pdo);
    $data = new DateTime($_POST['data']);
    $repoCat = new RepositorioCategoriaEmBDR($pdo);
    $cat = $repoCat->categoriaComId(htmlspecialchars($_POST['categoria']));
    $equip = new Equipamento(0, htmlspecialchars($_POST['descricao']),htmlspecialchars($_POST['codigo']),htmlspecialchars($_POST['situacao']),$data, $cat);
    $repo->adicionar($equip);
    header('Location : listagem.php');
    http_response_code(200);
}catch(PDOException $e){
    http_response_code(500);
    die('ERRO DE SERVIDOR');
}

?>
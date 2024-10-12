<?php
declare(strict_types= 1);
require_once './src/RepositorioEquipamentoEmBDR.php';
require_once 'conectar.php';

$id = $_GET['id'];
$pdo = null;
if(!isset($id)){
    http_response_code(400);
    die('Campo id não foi enviado');
}

if(!is_numeric($id) || $id < 1){
    http_response_code(400);
    die('Id deve ser um número maior que zero');
}
try{
    $pdo = conectar();
    $repo = new RepositorioEquipamentoEmBDR($pdo);
    $excluiu = $repo->excluirPeloId(intval($id));
    if($excluiu){
        header('Location : listagem.php');
        http_response_code(200);
    }else{
        http_response_code(404);
        die('EQUIPAMENTO NAO ENCONTRADO');
    }
}catch(PDOException $e){
    http_response_code(500);
    die('Erro de servidor');
}
?>
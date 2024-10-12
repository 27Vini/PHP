<?php
require_once './src/Situacao.php';
require_once './src/Categoria.php';
require_once './src/RepositorioCategoriaEmBDR.php';
require_once './src/RepositorioEquipamentoEmBDR.php';
require_once 'conectar.php';
require_once './src/geracao-categoria.php';

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
$pdo = null;
$equipamento = null;
try{
    $pdo = conectar();
    $repo = new RepositorioEquipamentoEmBDR($pdo);
    $equipamento = $repo->equipamentoComId(intval($id));
    if($equipamento === null){
        throw new Exception('Equipamento não encontrado');
    }

}catch(Exception $e){
    die('Erro'. $e->getMessage());
}



?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamento</title>
</head>
<body>
    <h1>Alteração de Equipamento</h1>
    <form action="alterar.php" method="POST">
        <input type="hidden" name="id" id="id" value="<?php echo $equipamento->id; ?>">
        <label for="codigo">Codigo: </label>
        <input type="text" name="codigo" id="codigo" value="<?php echo $equipamento->codigo; ?>">
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" id="descricao" value="<?php echo $equipamento->descricao; ?>">
        <label for="situacao">Situação</label>
        <select name="situacao" id="situacao">
            <option value="U" <?php if($equipamento->situacao === SITUACAO_EM_USO) echo 'selected';?>>Em uso</option>
            <option value="D" <?php if($equipamento->situacao === SITUACAO_COM_DEFEITO) echo 'selected';?>>Com Defeito</option>
            <option value="E" <?php if($equipamento->situacao === SITUACAO_EMBALADO) echo 'selected';?>>Embalado</option>
        </select>
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
            <?php
            desenharCategorias($categorias,$equipamento->id);
            ?>
        </select>
        <label for="data">Cadastro Em</label>
        <input type="date" name="data" id="data">
        <button type="submit">ENVIAR</button>
    </form>
</body>
</html>
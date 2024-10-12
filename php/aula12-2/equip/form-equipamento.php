<?php
require_once './src/Situacao.php';
require_once './src/Categoria.php';
require_once './src/RepositorioCategoriaEmBDR.php';
require_once 'conectar.php';
require_once './src/geracao-categoria.php';

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamento</title>
</head>
<body>
    <h1>Cadastro de Eequipamento</h1>
    <form action="inserirEquipamento.php" method="POST">
        <label for="codigo">Codigo: </label>
        <input type="text" name="codigo" id="codigo">
        <label for="descricao">Descrição: </label>
        <input type="text" name="descricao" id="descricao">
        <label for="situacao">Situação</label>
        <select name="situacao" id="situacao">
            <option value="<?php echo array_search('Em uso',SITUACAO_VALORES);  ?>">Em uso</option>
            <option value="<?php echo array_search('Com defeito',SITUACAO_VALORES);  ?>">Com Defeito</option>
            <option value="<?php echo array_search('Embalado',SITUACAO_VALORES);  ?>">Embalado</option>
        </select>
        <label for="categoria">Categoria</label>
        <select name="categoria" id="categoria">
            <?php
            desenharCategorias($categorias);
            ?>
        </select>
        <label for="data">Cadastro Em</label>
        <input type="date" name="data" id="data">
        <button type="submit">ENVIAR</button>
    </form>
</body>
</html>
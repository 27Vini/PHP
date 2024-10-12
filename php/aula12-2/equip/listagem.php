            <?php
            require_once './src/RepositorioEquipamentoEmBDR.php';
            require_once './src/Categoria.php';
            require_once './src/Equipamento.php';
            require_once './src/Situacao.php';
            require_once 'conectar.php';
            function gerarLinhasComEquipamentos(){
                $pdo= null;
                try{
                $pdo = conectar();
                $repo = new RepositorioEquipamentoEmBDR($pdo);
                $equipamentos = $repo->equipamentos();
                } catch(PDOException $e){
                    die('Erro: '. $e->getMessage());
                }
                foreach($equipamentos as $e){
                    $situacao = SITUACAO_VALORES[$e->situacao];
                    $linha = <<<HTML
                    <tr>
                        <td>{$e->id}</td>
                        <td>{$e->codigo}</td>
                        <td>{$e->descricao}</td>
                        <td>{$situacao}</td>
                        <td>{$e->categoria->descricao}</td>
                        <td>{$e->cadastro->format('d/m/Y H:i:s')}</td>
                        <td><a href="excluirEquipamento.php?id=$e->id">❌</a></td>
                        <td><a href="alteracao.php?id=$e->id">✏️</a></td>
                    </tr>
                    HTML;
                    echo $linha . PHP_EOL;
                }
            }
            
            ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipamentos</title>
</head>
<body>
    <h1>Equipamentos</h1>
    <a href="form-equipamento.php">Novo</a>
    <table border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Código</th>
                <th>Descrição</th>
                <th>Situação</th>
                <th>Categoria</th>
                <th>Cadastro em</th>
                <th>Excluir</th>
                <th>Alterar</th>
            </tr>
        </thead>
        <tbody>
        <?php
            gerarLinhasComEquipamentos();
        ?>
        </tbody>
    </table>
</body>
</html>

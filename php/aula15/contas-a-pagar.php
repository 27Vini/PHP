<?php
require_once "./conexao.php";
require_once './RepositorioContaEmBDR.php';
require_once './Conta.php';

function obterContas(){
    $pdo = null;
    $contas = [];
    try{
        $pdo = conectar();
        $repo = new RepositorioContaEmBDR($pdo);
        $contas = $repo->listarTodos();
    }catch(PDOException $e){
        http_response_code(500);
        die('ERRO DE SERVIDOR');
    }
    $json = json_encode($contas);
    header('Content-Type: application/json'); #precisa disso pro JS entender como json
    http_response_code(200);
    die($json);
}

function obterContaPeloId($url){
    $pedacos = explode("/", $url);
    $ultimoIndice = count($pedacos) - 1;
    $id = $pedacos[$ultimoIndice];
    if(!is_numeric($id)){
        http_response_code(400);
        die("Por favor informe um id numerico");
    }
    if('/contas-a-pagar/' . $id != $url){
        http_response_code(400);
        die('URL invalida');
    }
    $conta = null;
    $pdo = null;
    try{
        $pdo = conectar();
        $repo = new RepositorioContaEmBDR($pdo);
        $conta = $repo->obterPeloId($id);
    }catch(PDOException $e){
        http_response_code(500);
        die('ERRO DE SERVIDOR');
    }
    if($conta == null){
        http_response_code(404);
        die('Conta nao encontrada 🤷‍♂️');
    }
    header('Content-Type: application/json');
    http_response_code(200);
    die(json_encode($conta));
}


function removerContaPeloId($url){
    $pedacos = explode("/", $url);
    $ultimoIndice = count($pedacos) - 1;
    $id = $pedacos[$ultimoIndice];
    if(!is_numeric($id)){
        http_response_code(400);
        die("Por favor informe um id numerico");
    }
    if('/contas-a-pagar/' . $id != $url){
        http_response_code(400);
        die('URL invalida');
    }
    $conta = null;
    $pdo = null;
    try{
        $pdo = conectar();
        $repo = new RepositorioContaEmBDR($pdo);
        $deletou = $repo->deletar($id);
        if(!$deletou){
            http_response_code(404);
            die('CONTA NAO ENCONTRADA');
        }
    }catch(PDOException $e){
        http_response_code(500);
        die('ERRO DE SERVIDOR');
    }
    http_response_code(204);
    die();
}

function cadastrarConta(){
    $pdo = null;
    $json = file_get_contents('php://input');
    $dados = (array) json_decode($json);
    $conta = new Conta(0,$dados['descricao'],$dados['valor']);
    try{
        $pdo = conectar();
        $repo = new RepositorioContaEmBDR($pdo);
        $repo->adicionar($conta);
        http_response_code(201);
    }catch(PDOException $e){
        http_response_code(500);
        die('ERRO DE CONEXAO '. $e->getMessage());
    }

}

function atualizarConta($url){
    $json = file_get_contents('php://input');
    $dados = (array) json_decode($json);
    $pedacos = explode("/", $url);
    $ultimoIndice = count($pedacos) - 1;
    $id = $pedacos[$ultimoIndice];
    $conta = new Conta($id,$dados['descricao'],$dados['valor']);
    $pdo = null;
    try{
        $pdo = conectar();
        $repo = new RepositorioContaEmBDR($pdo);
        $repo->alterar($conta);
    }catch(PDOException $e){
        http_response_code(500);
        die('Erro: '. $e->getMessage());
    }
}

function deletarConta($url){
    $pedacos = explode("/", $url);
    $ultimoIndice = count($pedacos) - 1;
    $id = $pedacos[$ultimoIndice];
    if(!is_numeric($id)){
        http_response_code(400);
        die('ID INVALIDO');
    }
    if($url != "/contas-a-pagar/".$id){
        http_response_code(400);
        die("URL invalida");
    }
    try{
        $pdo = conectar();
        $repo = new RepositorioContaEmBDR($pdo);
        $deletou = $repo->deletar($id);
        if(!$deletou){
            http_response_code(404);
            die("CONTA NAO ENCONTRADA");
        }
        http_response_code(204);
        die();
    }catch(PDOException $e){
        http_response_code(500);
        die("ERRO DE SERVIDOR");
    }
}


?>
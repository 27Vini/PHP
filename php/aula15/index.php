<?php
require_once './contas-a-pagar.php';
$metodo = $_SERVER['REQUEST_METHOD'];
$url = mb_strtolower( $_SERVER['REQUEST_URI']);

if($metodo == 'GET' && $url == "/contas-a-pagar"){
    obterContas();
}else if ($metodo == 'POST' && $url == "/contas-a-pagar"){
    cadastrarConta();
}else if($metodo == 'GET' && mb_strpos($url,"/contas-a-pagar")!== false){
    obterContaPeloId($url);
}else if($metodo == 'PUT' && mb_strpos($url,"/contas-a-pagar")!== false){
    atualizarConta($url);
}else if($metodo == "DELETE" && mb_strpos($url,"/contas-a-pagar") !== false){
    deletarConta($url);
}

else{
    http_response_code(404);
    die('NAO ACHEI 🤷‍♂️');
}


?>
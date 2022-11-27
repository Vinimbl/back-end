<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET,PUT,POST,DELETE");

include_once 'conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);


if($dados){
    
    $query_usuario = "INSERT INTO usuario (nome,email,telefone,logradouro) VALUES (:nome, :email, :telefone, :logradouro)";
    $cad_usuario = $conn->prepare($query_usuario);
    $cad_usuario->bindParam(':nome', $dados['usuario']['nome']);
    $cad_usuario->bindParam(':email', $dados['usuario']['email']);
    $cad_usuario->bindParam(':telefone', $dados['usuario']['telefone']);
    $cad_usuario->bindParam(':logradouro', $dados['usuario']['logradouro']);

    $cad_usuario->execute();

    if($cad_usuario->rowCount()){
        $response = [
            "erro" => false,
            "mensagem" => "Usuário cadastrado com sucesso."
        ];
    }else{
        $response = [
            "erro" => true,
            "mensagem" => "Não foi possível cadastrar o usuário."
        ];
    }

    
}else{
    $response = [
        "erro" => true,
        "mensagem" => "Não foi possível cadastrar o usuário."
    ];
    }
http_response_code(200);
echo json_encode($response);
<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: *");



include_once 'conexao.php';

$response_json = file_get_contents("php://input");
$dados = json_decode($response_json, true);

if($dados){
    $query_usuario = "UPDATE usuario SET nome=:nome, email=:email, telefone=:telefone, logradouro=:logradouro WHERE id=:id";
    $edit_usuario = $conn->prepare($query_usuario);

    $edit_usuario->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
    $edit_usuario->bindParam(':email', $dados['email'], PDO::PARAM_STR);
    $edit_usuario->bindParam(':telefone', $dados['telefone'], PDO::PARAM_INT);
    $edit_usuario->bindParam(':logradouro', $dados['logradouro'], PDO::PARAM_STR);
    $edit_usuario->bindParam(':id', $dados['id'], PDO::PARAM_INT);

    $edit_usuario->execute();

    if($edit_usuario->rowCount()){
        $response = [
            "erro" => false,
            "mensagem" => "Usuário editado com sucesso."
        ];
    }else{
        $response = [
            "erro" => false,
            "mensagem" => "Não foi possível editar o usuário."
        ];
    }
}else{
    $response = [
        "erro" => false,
        "mensagem" => "Não foi possível editar o usuário."
    ];
}

http_response_code(200);
echo json_encode($response);
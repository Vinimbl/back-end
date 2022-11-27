<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once 'conexao.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$response = "";

$query_usuario = "DELETE FROM usuario WHERE id=:id LIMIT 1";
$delete_usuario = $conn->prepare($query_usuario);
$delete_usuario->bindParam(':id', $id, PDO::PARAM_INT);

if($delete_usuario->execute()){
    $response = [
        "erro" => false,
        "mensagem" => "Usuário apagado com sucessoç."
    ];
}else{
    $response = [
        "erro" => true,
        "mensagem" => "Erro: Não foi possível apagar o usuário."
    ];
}

http_response_code(200);
echo json_encode($response);

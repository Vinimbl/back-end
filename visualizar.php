<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


include_once 'conexao.php';


$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$response = "";

$query_usuario = "SELECT id, nome, email, telefone, logradouro FROM usuario WHERE id=:id LIMIT 1";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->bindParam(':id', $id, PDO::PARAM_INT);
$result_usuario->execute();

if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    extract($row_usuario);

    $usuario = [
        'id' => $id,  
        'nome' => $nome,
        'email' => $email,
        'telefone' => $telefone,
        'logradouro' => $logradouro
    ];

    $response = [
        "erro"=> false,
        "usuario" => $usuario
    ];
}else{
    $response = [
        "erro"=> true,
        "messagem" => "Usuário não encontrado"
    ];
}
http_response_code(200);
echo json_encode($response);

<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once 'conexao.php';

$query_usuario = "SELECT id, nome, email, telefone, logradouro FROM usuario";
$result_usuario = $conn->prepare($query_usuario);
$result_usuario->execute();

if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
    while($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)){
        extract($row_usuario);

        $lista_usuario["records"][$id] = [
            'id' => $id,
            'nome' => $nome,
            'email' => $email,
            'telefone' => $telefone,
            'logradouro' => $logradouro
        ];
    }

    
    http_response_code(200);
    echo json_encode($lista_usuario);
}
<?php
require_once '../config/conector.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)) {
    $detalhes = "SELECT `id`, `cadastro`, `nome`, `user`, `senha`, `email`, `telefone`, `cargo` FROM `usuarios` WHERE id = :id LIMIT 1 ";
    $result_detalhes = $conn->prepare($detalhes);
    $result_detalhes->bindParam(':id', $id);
    $result_detalhes->execute();

    if(($result_detalhes) and ($result_detalhes->rowCount() != 0)){
        $row_user = $detalhes = $result_detalhes->fetch(PDO::FETCH_ASSOC);
        $retorna = [
            'status' => true,
            'dados' => $row_user
        ];
    } else {
        $retorna = ['status' => false, 'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Erro! Nenhum Produto encontrado.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"];
    }; 
} else {
    $retorna = ['status' => false, 'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
       Erro! Nenhum Produto encontrado. 2 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"];
    };

echo json_encode($retorna);
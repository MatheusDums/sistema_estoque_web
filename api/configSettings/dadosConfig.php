<?php

require_once '../config/conector.php';

// Forçar header para UTF-8
header('Content-Type: application/json; charset=utf-8');

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$totalUsers = "SELECT COUNT(*) AS usuariosTotais FROM usuarios";
$result_qtd = $conn->prepare($totalUsers);
$result_qtd->execute();
$totalUsuarios = $result_qtd->fetch(PDO::FETCH_ASSOC)['usuariosTotais'];


$sql = "SELECT id, nome, endereco, telefone, email FROM empresa /* WHERE nome = :nome */";
$stmt = $conn->prepare($sql);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

$dados = [
    'id' => $resultado['id'],
    'nome' => $resultado['nome'],
    'endereco' => $resultado['endereco'],
    'telefone' => $resultado['telefone'],
    'email' => $resultado['email'],
    'totalUsuarios' => $totalUsuarios
];

echo json_encode($dados, JSON_UNESCAPED_UNICODE);

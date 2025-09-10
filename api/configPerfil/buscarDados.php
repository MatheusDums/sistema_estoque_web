<?php

require_once __DIR__ . '/../config/conector.php';

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$sql = "SELECT id, cadastro, nome, user, senha, email, telefone, cargo, empresa, imagem FROM usuarios /* WHERE nome = :nome */";
$stmt = $conn->prepare($sql);
$stmt->execute();

$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

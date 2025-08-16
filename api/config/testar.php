<?php
require_once './conector.php';

$senha = "123456";
// Verifica se a senha está correta
$detalhes = "SELECT `senha` FROM `usuarios`";
$result_detalhes = $conn->prepare($detalhes);
$result_detalhes->execute();
$result_detalhes = $result_detalhes->fetch(PDO::FETCH_ASSOC);

if(password_verify($senha, $result_detalhes['senha'])) {
    echo "Senha correta!";
} else {
    echo "Senha incorreta!";
}
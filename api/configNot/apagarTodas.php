<?php
require_once '../config/conector.php';

header("Content-Type: application/json; charset=UTF-8");

$stmt = $conn->prepare("DELETE FROM notificacoes");

if ($stmt->execute()) {
    echo json_encode(["status" => true, "msg" => "Todas as notificações foram apagadas."]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao apagar todas as notificações."]);
}
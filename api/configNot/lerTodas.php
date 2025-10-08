<?php
require_once '../config/conector.php';

header("Content-Type: application/json; charset=UTF-8");

$stmt = $conn->prepare("UPDATE notificacoes SET lida = 1 WHERE lida = 0");

if ($stmt->execute()) {
    echo json_encode(["status" => true, "msg" => "Todas as notificações foram marcadas como lidas."]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao marcar todas as notificações como lidas."]);
}
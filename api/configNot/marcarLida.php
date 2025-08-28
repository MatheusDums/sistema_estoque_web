<?php
require_once '../config/conector.php';

header("Content-Type: application/json; charset=UTF-8");

if (!isset($_POST['id'])) {
    echo json_encode(["status" => false, "msg" => "ID não informado"]);
    exit;
}

$id = intval($_POST['id']);

$stmt = $conn->prepare("UPDATE notificacoes SET lida = 1 WHERE id = :id");
$stmt->bindParam(":id", $id);

if ($stmt->execute()) {
    echo json_encode(["status" => true]);
} else {
    echo json_encode(["status" => false, "msg" => "Erro ao atualizar"]);
}

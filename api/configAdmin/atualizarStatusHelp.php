<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/conector.php';

$id_help = $_POST['id_help'] ?? null;
$status = $_POST['status'] ?? null;

if (!$id_help || !$status) {
    echo json_encode(["status" => false, "message" => "Dados incompletos."]);
    exit;
}

try {
    $sql = "UPDATE help SET status_help = :status WHERE id_help = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id_help);
    $stmt->execute();

    echo json_encode(["status" => true, "message" => "Status atualizado com sucesso!"]);
} catch (PDOException $e) {
    echo json_encode(["status" => false, "message" => "Erro: " . $e->getMessage()]);
}

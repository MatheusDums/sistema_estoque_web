<?php
require_once __DIR__ . '/../config/conector.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        $query = "DELETE FROM recados WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Recado excluído com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Erro ao excluir o recado']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID inválido']);
    }
}
?>

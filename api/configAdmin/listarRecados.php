<?php
require_once __DIR__ . '/../config/conector.php';


function listarRecados($conn) {
    $query = "SELECT id, titulo, mensagem, admin, criado FROM recados ORDER BY criado DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

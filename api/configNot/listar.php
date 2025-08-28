<?php
require_once '../config/conector.php';

header("Content-Type: application/json; charset=UTF-8");

$stmt = $conn->prepare("SELECT id, titulo, mensagem, lida, criada_em 
                        FROM notificacoes 
                        ORDER BY criada_em DESC");
$stmt->execute();
$notificacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($notificacoes);

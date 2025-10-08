<?php
require_once __DIR__ . '/../config/conector.php';

/* buscar quantidade de produtos */
$sql = "SELECT COUNT(*) as total FROM produtos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$resultadoProdutos = $row['total'];

/* buscar quantidade de usuarios */
$sql = "SELECT COUNT(*) as total FROM usuarios";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$resultadoUsuarios = $row['total'];

/* buscar valor total do estoque */
$sql = "SELECT SUM(valor * quantidade) as valor_total FROM produtos";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$valorTotalEstoque = $row['valor_total'] ?? 0; // Garante 0 se não houver produtos

/* buscar total de HelpDesks ativos */
$sql = "SELECT COUNT(*) as total FROM help WHERE status_help != 'Concluido' AND status_help != 'Finalizado'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$resultadoHelpDesks = $row['total'];
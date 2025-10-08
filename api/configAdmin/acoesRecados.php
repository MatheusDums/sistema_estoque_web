<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/conector.php';

// Garante que o PDO lance exceções
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados_cadastro['titulo']) || empty($dados_cadastro['recado']) || empty($dados_cadastro['admin'])) {
    $resposta = [
        "status" => false,
        "message" => "Preencha todos os campos!"
    ];
    echo json_encode($resposta);
    exit;
}

$titulo = trim($dados_cadastro['titulo']);
$recado = trim($dados_cadastro['recado']);
$admin  = trim($dados_cadastro['admin']);

try {
    $sql = "INSERT INTO recados (titulo, mensagem, admin) VALUES (:titulo, :recado, :admin)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':titulo', $titulo, PDO::PARAM_STR);
    $stmt->bindValue(':recado', $recado, PDO::PARAM_STR);
    $stmt->bindValue(':admin', $admin, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $resposta = [
            "status" => true,
            "message" => "Recado cadastrado com sucesso!"
        ];
    } else {
        $resposta = [
            "status" => false,
            "message" => "Erro ao cadastrar recado."
        ];
    }
} catch (PDOException $e) {
    $resposta = [
        "status" => false,
        "message" => "Erro no banco: " . $e->getMessage()
    ];
}

echo json_encode($resposta);

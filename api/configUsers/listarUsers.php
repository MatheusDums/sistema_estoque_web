<?php

require_once '../config/conector.php';

$dados_requisicao = $_REQUEST;

$colunas = [
    0 => 'cadastro',
    1 => 'nome',
    2 => 'user',
    3 => 'email',
    4 => 'telefone',
    5 => 'cargo',
];

// Total de registros SEM filtro
$sqlCount = "SELECT COUNT(*) AS total FROM usuarios";
$result_qtd = $conn->prepare($sqlCount);
$result_qtd->execute();
$totalRegistros = $result_qtd->fetch(PDO::FETCH_ASSOC)['total'];

$start = isset($dados_requisicao['start']) ? intval($dados_requisicao['start']) : 0;
$length = isset($dados_requisicao['length']) ? intval($dados_requisicao['length']) : 10;

$colunaIndex = isset($dados_requisicao['order'][0]['column']) ? intval($dados_requisicao['order'][0]['column']) : 0;
$colunaOrdenar = isset($colunas[$colunaIndex]) ? $colunas[$colunaIndex] : 'cadastro';

$orderDir = (isset($dados_requisicao['order'][0]['dir']) && strtolower($dados_requisicao['order'][0]['dir']) === 'desc') ? 'DESC' : 'ASC';

$where = "";
if (!empty($dados_requisicao['search']['value'])) {
    $where = " WHERE nome LIKE :search 
               OR cadastro LIKE :search
               OR user LIKE :search 
               OR email LIKE :search 
               OR telefone LIKE :search
               OR cargo LIKE :search";
}

// Total de registros COM filtro
$sqlFiltered = "SELECT COUNT(*) AS total FROM usuarios " . $where;
$stmtFiltered = $conn->prepare($sqlFiltered);
if (!empty($dados_requisicao['search']['value'])) {
    $searchTerm = '%' . $dados_requisicao['search']['value'] . '%';
    $stmtFiltered->bindValue(':search', $searchTerm, PDO::PARAM_STR);
}
$stmtFiltered->execute();
$totalFiltrado = $stmtFiltered->fetch(PDO::FETCH_ASSOC)['total'];

// Consulta final com LIMIT
$listar = "SELECT id, cadastro, nome, user, senha, email, telefone, cargo
           FROM usuarios 
           $where 
           ORDER BY $colunaOrdenar $orderDir 
           LIMIT $start, $length";

$result_listar = $conn->prepare($listar);
if (!empty($dados_requisicao['search']['value'])) {
    $result_listar->bindValue(':search', $searchTerm, PDO::PARAM_STR);
}
$result_listar->execute();

// Monta array de dados
$dados = [];
while ($row_usuario = $result_listar->fetch(PDO::FETCH_ASSOC)) {
    $id = $row_usuario['id'];
    $cadastro = $row_usuario['cadastro'];
    $nome = $row_usuario['nome'];
    $user = $row_usuario['user'];
    $senha = $row_usuario['senha'];
    $email = $row_usuario['email'];
    $telefone = $row_usuario['telefone'];
    $cargo = $row_usuario['cargo'];
    $registro = [];
    $registro[] = $cadastro;
    $registro[] = $nome;
    $registro[] = $user;
    $registro[] = $email;
    $registro[] = $telefone;
    $registro[] = $cargo;
    $registro[] = "<button type='button' id='$id' class='btn btn-primary' onclick='visUser($id)'><i class='bi bi-list-columns'></i></button>
                    <button type='button' id='$id' class='btn btn-secondary' onclick='editUser($id)'><i class='bi bi-pencil-fill'></i></button> 
                    <button type='button' id='$id' class='btn btn-danger' onclick='deleteUser($id)'><i class='bi bi-trash'></i></button>";
    $dados[] = $registro;
}

// Retorno para DataTables
$resultado = [
    "draw" => isset($dados_requisicao['draw']) ? intval($dados_requisicao['draw']) : 0,
    "recordsTotal" => intval($totalRegistros),
    "recordsFiltered" => intval($totalFiltrado),
    "data" => $dados
];

echo json_encode($resultado);
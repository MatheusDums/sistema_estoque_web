<?php

require_once '../config/conector.php';

$dados_requisicao = $_REQUEST;

$colunas = [
    0 => 'id',
    1 => 'nome',
    2 => 'email',
    3 => 'empresa',
    4 => 'area',
    5 => 'mensagem',
];

// Total de registros SEM filtro
$sqlCount = "SELECT COUNT(*) AS total FROM `futuras-imp`";
$result_qtd = $conn->prepare($sqlCount);
$result_qtd->execute();
$totalRegistros = $result_qtd->fetch(PDO::FETCH_ASSOC)['total'];

$start = isset($dados_requisicao['start']) ? intval($dados_requisicao['start']) : 0;
$length = isset($dados_requisicao['length']) ? intval($dados_requisicao['length']) : 10;

$colunaIndex = isset($dados_requisicao['order'][0]['column']) ? intval($dados_requisicao['order'][0]['column']) : 0;
$colunaOrdenar = isset($colunas[$colunaIndex]) ? $colunas[$colunaIndex] : 'id';

$orderDir = (isset($dados_requisicao['order'][0]['dir']) && strtolower($dados_requisicao['order'][0]['dir']) === 'desc') ? 'DESC' : 'ASC';

$where = "";
if (!empty($dados_requisicao['search']['value'])) {
    $where = " WHERE nome LIKE :search 
               OR id LIKE :search
               OR email LIKE :search 
               OR empresa LIKE :search
               OR area LIKE :search
               OR mensagem LIKE :search";
}

// Total de registros COM filtro
$sqlFiltered = "SELECT COUNT(*) AS total FROM `futuras-imp` " . $where;
$stmtFiltered = $conn->prepare($sqlFiltered);
if (!empty($dados_requisicao['search']['value'])) {
    $searchTerm = '%' . $dados_requisicao['search']['value'] . '%';
    $stmtFiltered->bindValue(':search', $searchTerm, PDO::PARAM_STR);
}
$stmtFiltered->execute();
$totalFiltrado = $stmtFiltered->fetch(PDO::FETCH_ASSOC)['total'];

// Consulta final com LIMIT
$listar = "SELECT id, nome, email, empresa, area, mensagem
           FROM `futuras-imp` 
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
    $nome = $row_usuario['nome'];
    $email = $row_usuario['email'];
    $empresa = $row_usuario['empresa'];
    $area = $row_usuario['area'];
    $mensagem = $row_usuario['mensagem'];
    $registro = [];
    $registro[] = $id;
    $registro[] = $nome;
    $registro[] = $email;
    $registro[] = $empresa;
    $registro[] = $area;
    $registro[] = $mensagem;
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
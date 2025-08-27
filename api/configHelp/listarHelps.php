<?php

require_once '../config/conector.php';

$dados_requisicao = $_REQUEST;

$colunas = [
    0 => 'id_help',
    1 => 'user',
    2 => 'assunto',
    3 => 'nivel',
    4 => 'status_help',
];

// Total de registros SEM filtro
$sqlCount = "SELECT COUNT(*) AS total FROM help";
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
$sqlFiltered = "SELECT COUNT(*) AS total FROM help " . $where;
$stmtFiltered = $conn->prepare($sqlFiltered);
if (!empty($dados_requisicao['search']['value'])) {
    $searchTerm = '%' . $dados_requisicao['search']['value'] . '%';
    $stmtFiltered->bindValue(':search', $searchTerm, PDO::PARAM_STR);
}
$stmtFiltered->execute();
$totalFiltrado = $stmtFiltered->fetch(PDO::FETCH_ASSOC)['total'];

// Consulta final com LIMIT
$listar = "SELECT id_help, user, assunto, area, nivel, status_help, descricao, imagem, contato
           FROM help 
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
    $id = $row_usuario['id_help'];
    $user = $row_usuario['user'];
    $assunto = $row_usuario['assunto'];
    $area = $row_usuario['area'];
    $nivel = $row_usuario['nivel'];
    $status = $row_usuario['status_help'];
    $descricap = $row_usuario['descricao'];
    $imagem = $row_usuario['imagem'];
    $contato = $row_usuario['contato'];
    $registro = [];
    $registro[] = "#" . $id;
    $registro[] = $user;
    $registro[] = $assunto;
    $registro[] = $nivel;
    $registro[] = $status;
    $registro[] = "<button type='button' id='$id' class='btn btn-secondary' onclick='visUser($id)'> Detalhes do chamado</button>";
    $dados[] = $registro;
}

// Retorno pro DataTables
$resultado = [
    "draw" => isset($dados_requisicao['draw']) ? intval($dados_requisicao['draw']) : 0,
    "recordsTotal" => intval($totalRegistros),
    "recordsFiltered" => intval($totalFiltrado),
    "data" => $dados
];

echo json_encode($resultado);
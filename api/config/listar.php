<?php
include './conector.php';

$dados_requisicao = $_REQUEST;

$sqlCount = "SELECT COUNT(*) FROM produtos";
$result_qtd = $conn->prepare($sqlCount);
$result_qtd->execute();
$totalRegistros = $result_qtd->fetch(PDO::FETCH_ASSOC);

$colunas = [
    0 => 'codigo',
    1 => 'nome',
    2 => 'estoque',
    3 => 'quantidade',
    4 => 'valor',
    5 => 'categoria',
    6 => 'descricao'
];

$start = isset($dados_requisicao['start']) ? intval($dados_requisicao['start']) : 0;
$length = isset($dados_requisicao['length']) ? intval($dados_requisicao['length']) : 10;

$colunaIndex = isset($dados_requisicao['order'][0]['column']) ? intval($dados_requisicao['order'][0]['column']) : 0;
$colunaOrdenar = isset($colunas[$colunaIndex]) ? $colunas[$colunaIndex] : 'codigo';

$orderDir = (isset($dados_requisicao['order'][0]['dir']) && strtolower($dados_requisicao['order'][0]['dir']) === 'desc') ? 'DESC' : 'ASC';

$listar = "SELECT nome, codigo, estoque, quantidade, valor, categoria, descricao FROM produtos";
$listar .= " ORDER BY $colunaOrdenar $orderDir "
                . " LIMIT  $start, $length"; ;
$result_listar = $conn->prepare($listar);
$result_listar->execute();

$dados = [];
while ($row_usuario = $result_listar->fetch(PDO::FETCH_ASSOC)) {
    $registro = [];
    $registro[] = $row_usuario['codigo'];
    $registro[] = $row_usuario['nome'];
    $registro[] = $row_usuario['estoque'];
    $registro[] = $row_usuario['quantidade'];
    $registro[] = $row_usuario['valor'];
    $registro[] = $row_usuario['categoria'];
    $registro[] = $row_usuario['descricao'];
    $dados[] = $registro;
}

$resultado = [
    "draw" => isset($dados_requisicao['draw']) ? intval($dados_requisicao['draw']) : 0,
    "recordsTotal" => intval($totalRegistros),
    "recordsFiltered" => intval($totalRegistros),
    "data" => $dados
];

echo json_encode($resultado);

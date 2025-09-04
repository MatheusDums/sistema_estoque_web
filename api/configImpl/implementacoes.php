<?php
require_once '../config/conector.php';
header('Content-Type: application/json; charset=utf-8');

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(
    empty($dados_cadastro['nome']) ||
    empty($dados_cadastro['email']) ||
    empty($dados_cadastro['empresa']) ||
    empty($dados_cadastro['area']) ||
    empty($dados_cadastro['mensagem'])
){
    $resposta = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Preencha todos os campos!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
    ];
    echo json_encode($resposta);
    exit;
}

try {
    // ATENÇÃO: use a mesma variável de conexão do seu projeto (ex.: $conn)
    $sql = "INSERT INTO `futuras-imp` (nome, email, empresa, area, mensagem)
            VALUES (:nome, :email, :empresa, :area, :mensagem)";

    $stmt = $conn->prepare($sql); // se no seu conector é $pdo, troque aqui para $pdo->prepare

    $stmt->bindParam(':nome', $dados_cadastro['nome']);
    $stmt->bindParam(':email', $dados_cadastro['email']);
    $stmt->bindParam(':empresa', $dados_cadastro['empresa']);
    $stmt->bindParam(':area', $dados_cadastro['area']);
    $stmt->bindParam(':mensagem', $dados_cadastro['mensagem']);

    if($stmt->execute()){
        $resposta = [
            "status" => true,
            "message" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Sugestão enviada com sucesso! Obrigado por colaborar para a nossa constante melhora.
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    } else {
        $resposta = [
            "status" => false,
            "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erro ao enviar a sugestão!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    }
} catch (Throwable $e) {
    // Em produção, substitua a mensagem abaixo por algo genérico para não vazar detalhes do servidor.
    $resposta = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Erro no servidor: ".$e->getMessage()."
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
    ];
}

echo json_encode($resposta);
exit;

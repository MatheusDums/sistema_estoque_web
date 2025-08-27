<?php
require_once '../config/conector.php';

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados_cadastro['user']) ||
    empty($dados_cadastro['assunto']) ||
    empty($dados_cadastro['area']) ||
    empty($dados_cadastro['desc']) ||
    empty($dados_cadastro['contato'])) {
    $resposta = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Preencha todos os campos!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
    ];
} else {
    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {

        $pasta =__DIR__ . "/../../assets/arquivos/uploadsHelp/";

        $nomeArquivo = uniqid() . "-" . basename($_FILES['imagem']['name']);
        $caminho = $pasta . $nomeArquivo;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            $imagem = "../arquivos/uploadsHelp/" . $nomeArquivo;
        }else {
            $imagem = null;
    }
    }

    $cadastrar = "INSERT INTO help (user, assunto, area, nivel, status_help, descricao, imagem, contato) 
     VALUES (:user, :assunto, :area, :nivel, :status_help, :descricao, :imagem, :contato)";
    $result_cadastrar = $conn->prepare($cadastrar);
    $result_cadastrar->bindParam(':user', $dados_cadastro['user']);
    $result_cadastrar->bindParam(':assunto', $dados_cadastro['assunto']);
    $result_cadastrar->bindParam(':area', $dados_cadastro['area']);
    $result_cadastrar->bindParam(':nivel', $dados_cadastro['nivel']);
    $result_cadastrar->bindParam(':status_help', $dados_cadastro['status_help']);
    $result_cadastrar->bindParam(':descricao', $dados_cadastro['desc']);
    $result_cadastrar->bindParam(':contato', $dados_cadastro['contato']);
    $imagem = !empty($dados_cadastro['imagem']) ? $dados_cadastro['imagem'] : null;
    $result_cadastrar->bindParam(':imagem', $imagem);

    $result_cadastrar->execute();

    if($result_cadastrar->rowCount()){
        $resposta = [
            "status" => true,
            "message" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Chamado cadastrado com sucesso!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    } else {
        $resposta = [
            "status" => false,
            "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erro ao cadastrar Chamado!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    }
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($resposta);
exit;
<?php
require_once './conector.php';

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados_cadastro['nome']) || empty($dados_cadastro['codigo']) 
   || empty($dados_cadastro['valor']) || empty($dados_cadastro['categoria'])) {
    $resposta = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Preencha todos os campos!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
    ];
} else {
    $cadastrar = "INSERT INTO produtos (nome, codigo, estoque, quantidade, valor, categoria, descricao) 
     VALUES (:nome, :codigo, :estoque, :quantidade, :valor, :categoria, :descricao)";
    $result_cadastrar = $conn->prepare($cadastrar);
    $result_cadastrar->bindParam(':nome', $dados_cadastro['nome']);
    $result_cadastrar->bindParam(':codigo', $dados_cadastro['codigo']);
    $result_cadastrar->bindParam(':estoque', $dados_cadastro['disponivel']);
    $result_cadastrar->bindParam(':quantidade', $dados_cadastro['quantidade']);
    $result_cadastrar->bindParam(':valor', $dados_cadastro['valor']);
    $result_cadastrar->bindParam(':categoria', $dados_cadastro['categoria']);
    $result_cadastrar->bindParam(':descricao', $dados_cadastro['descricao']);
    $result_cadastrar->execute();

    if($result_cadastrar->rowCount()){
        $resposta = [
            "status" => true,
            "message" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Produto <b>". $dados_cadastro['nome'] . "</b> cadastrado com sucesso!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    } else {
        $resposta = [
            "status" => false,
            "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erro ao cadastrar o produto!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    }
}

echo json_encode($resposta);

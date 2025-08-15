<?php
require_once '../config/conector.php';

$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados_cadastro['cadastro']) || empty($dados_cadastro['nome']) 
   || empty($dados_cadastro['usuario']) || empty($dados_cadastro['senha']) || empty($dados_cadastro['cargo'])) {
    $resposta = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Preencha todos os campos!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
    ];
} else {
    $senha = password_hash($dados_cadastro['senha'], PASSWORD_DEFAULT);

    $cadastrar = "INSERT INTO usuarios (cadastro, nome, user, senha, email, telefone, cargo) 
     VALUES (:cadastro, :nome, :user, :senha, :email, :telefone, :cargo)";
    $result_cadastrar = $conn->prepare($cadastrar);
    $result_cadastrar->bindParam(':cadastro', $dados_cadastro['cadastro']);
    $result_cadastrar->bindParam(':nome', $dados_cadastro['nome']);
    $result_cadastrar->bindParam(':user', $dados_cadastro['usuario']);
    $result_cadastrar->bindParam(':senha', $senha);
    $result_cadastrar->bindParam(':email', $dados_cadastro['email']);
    $result_cadastrar->bindParam(':telefone', $dados_cadastro['telefone']);
    $result_cadastrar->bindParam(':cargo', $dados_cadastro['cargo']);
    $result_cadastrar->execute();

    if($result_cadastrar->rowCount()){
        $resposta = [
            "status" => true,
            "message" => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Usuário <b>". $dados_cadastro['nome'] . "</b> cadastrado com sucesso!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    } else {
        $resposta = [
            "status" => false,
            "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erro ao cadastrar Usuário!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    }
}

echo json_encode($resposta);

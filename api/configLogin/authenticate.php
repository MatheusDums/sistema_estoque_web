<?php
require_once __DIR__ . '/../config/conector.php';

/* Verificar dados do formulário primeiro */
$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados_cadastro['username']) || empty($dados_cadastro['password'])) {
    $_SESSION['msg_login'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Preencha todos os campos!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("Location: ../../login.php");
    exit();
}

$username = $dados_cadastro['username'];
$password = $dados_cadastro['password'];

/* Consulta ao banco de dados */
$sql = "SELECT id, cadastro, nome, user, senha, token, email, telefone, cargo, empresa, imagem FROM usuarios WHERE user = :user OR cadastro = :user";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user', $username, PDO::PARAM_STR);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

/* Verifica se encontrou o usuário */
if (!$resultado) {
    session_start();
    $_SESSION['msg_login'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Usuário não encontrado!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("Location: ../../login.php");
    exit();
}

/* Verifica se a senha está correta */
if ($password === $resultado['senha']) {
    // Autenticação bem-sucedida
    session_start();
    $_SESSION['logado'] = true;
    $_SESSION['user_id'] = $resultado['id'];
    $_SESSION['cadastro'] = $resultado['cadastro'];
    $_SESSION['nome'] = $resultado['nome'];
    $_SESSION['senha'] = $resultado['senha'];
    $_SESSION['token'] = $resultado['token'];
    $_SESSION['username'] = $resultado['user'];
    $_SESSION['email'] = $resultado['email'];
    $_SESSION['telefone'] = $resultado['telefone'];
    $_SESSION['cargo'] = $resultado['cargo'];
    $_SESSION['empresa'] = $resultado['empresa'];
    $_SESSION['imagem'] = $resultado['imagem'];

    header("Location: ../../index.php");
    exit();
} else {
    // Senha incorreta
    session_start();
    $_SESSION['msg_login'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Credenciais incorretas!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("Location: ../../login.php");
    exit();
}

<?php
require_once __DIR__ . '/../config/conector.php';

/* Verificar dados do formulário primeiro */
$dados_cadastro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados_cadastro['username']) || empty($dados_cadastro['password'])) {
    $_SESSION['msg_login'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Preencha todos os campos!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("Location: ../../admin/loginAdmin.php");
    exit();
}

$username = $dados_cadastro['username'];
$password = $dados_cadastro['password'];

/* Consulta ao banco de dados */
$sql = "SELECT id, nome, user_admin, user_pass, token FROM admin_login WHERE user_admin = :user";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':user', $username, PDO::PARAM_STR);
$stmt->execute();
$resultado = $stmt->fetch(PDO::FETCH_ASSOC);

/* Verifica se encontrou o usuário */
if (!$resultado) {
    $_SESSION['msg_login'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Usuário não encontrado!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("Location: ../../admin/loginAdmin.php");
    exit();
}

/* Verifica se a senha está correta */
if ($password === $resultado['user_pass']) {
    // Autenticação bem-sucedida
    session_start();
    $_SESSION['logado'] = true;
    $_SESSION['user_id'] = $resultado['id'];
    $_SESSION['nome'] = $resultado['nome'];
    $_SESSION['senha'] = $resultado['user_pass'];
    $_SESSION['token'] = $resultado['token'];
    $_SESSION['username'] = $resultado['user_admin'];

    // Gerar token de sessão com expiração de 5 horas
    
    $payload = json_encode([
        'nome' => $_SESSION['nome'],
        'user' => $_SESSION['username'],
        'exp' => time() + 18000 /* 5 horas para expirar, 18000 = 60 (seg) * 500 (min) */
    ]);
    $token = base64_encode($payload);

    if($token) {
        $atualiza = $conn->prepare("UPDATE admin_login SET token = :token WHERE id = :id");
        $atualiza->bindParam(':token', $token);
        $atualiza->bindParam(':id', $_SESSION['user_id']);
        $atualiza->execute();
    }


    header("Location: ../../admin/admin.php");
    exit();
} else {
    // Senha incorreta
    session_start();
    $_SESSION['msg_login'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Credenciais incorretas!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";
    header("Location: ../../admin/loginAdmin.php");
    exit();
}

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/conector.php';

function invalidate_session_and_redirect() {
    $_SESSION = [];

    session_destroy();

    session_start();
    $_SESSION['msg_login'] = "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        Sua sessão expirou ou é inválida! Por favor, faça login novamente.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
    </div>";

    $login_path = '/sistema_teste/login.php';
    
    header("Location: " . $login_path);
    exit();
}

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['user_id'])) {
    invalidate_session_and_redirect();
}

try {
    $sql = "SELECT token FROM usuarios WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $_SESSION['user_id'], PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && !empty($user['token'])) {
        $payload = json_decode(base64_decode($user['token']), true);

        if ($payload === null || !isset($payload['exp']) || time() > $payload['exp']) {
            invalidate_session_and_redirect();
        }
    } else {
        invalidate_session_and_redirect();
    }
} catch (PDOException $e) {
    invalidate_session_and_redirect();
}

?>
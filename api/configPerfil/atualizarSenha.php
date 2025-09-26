<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/conector.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['id'])) {
    $retorna = [
        'status' => false,
        'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Erro! Nenhum ID informado. Tente  novamente mais tarde.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"
    ];
} elseif(empty($dados['senha'])) {
    $retorna = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Preencha todos os campos!
        </div>"
    ];
} else {
    $editar = "UPDATE usuarios SET senha=:senha WHERE id = :id";
    $editar = $conn->prepare($editar);
    /* $senha = password_hash($dados['senha'], PASSWORD_DEFAULT); */
    $editar->bindParam(':senha', $dados['senha']);
    $editar->bindParam(':id', $dados['id']);

    if($editar->execute()) {
        $retorna = [
            'status' => true,
            'message' => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                Senha atualizada com sucesso!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    } else {
        $retorna = [
            'status' => false,
            'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Erro ao atualizar a senha.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>"
        ];
    }
}

header('Content-Type: application/json');
echo json_encode($retorna);
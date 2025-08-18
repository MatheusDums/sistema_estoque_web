<?php
require_once '../config/conector.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if(empty($dados['id_user'])) {
    $retorna = ['status' => false, 'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Erro! Nenhum ID  informado. Tente  novamente mais tarde.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"];
} elseif(empty($dados['cadastro_user']) || empty($dados['nome_user']) 
   || empty($dados['usuario_user']) || empty($dados['senha_user']) || empty($dados['cargo_user'])) {
    $retorna = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Preencha todos os campos!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
    ];
} else {
     $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $pasta = __DIR__ . "/../../assets/arquivos/uploadsUsers/";
        $nomeArquivo = uniqid() . "-" . basename($_FILES['imagem']['name']);
        $caminho = $pasta . $nomeArquivo;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            $imagem = "../arquivos/uploadsUsers/" . $nomeArquivo;
        }
    }

    if ($imagem) {
        $editar = "UPDATE usuarios 
                   SET cadastro=:cadastro, nome=:nome, imagem=:imagem, user=:user, senha=:senha, 
                       email=:email, telefone=:telefone, cargo=:cargo
                   WHERE id = :id";
    } else {
        $editar = "UPDATE usuarios SET cadastro=:cadastro, nome=:nome, user=:user, senha=:senha, 
    email=:email, telefone=:telefone, cargo=:cargo WHERE id = :id";
    }

    $senha = password_hash($dados['senha_user'], PASSWORD_DEFAULT);
    $editar = $conn->prepare($editar);
    $editar->bindParam(':id', $dados['id_user']);
    $editar->bindParam(':cadastro', $dados['cadastro_user']);
    $editar->bindParam(':nome', $dados['nome_user']);
    if ($imagem) {
        $editar->bindParam(':imagem', $imagem);
    }
    $editar->bindParam(':user', $dados['usuario_user']);
    $editar->bindParam(':senha', $senha);
    $editar->bindParam(':email', $dados['email_user']);
    $editar->bindParam(':telefone', $dados['telefone_user']);
    $editar->bindParam(':cargo', $dados['cargo_user']);
    $editar->execute();

    if($editar->execute()) {
        $retorna = ['status' => true, 
                    'message' => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Usuário <b>". $dados['nome_user'] . "</b> Editado com Sucesso.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"];
    } else {
        $retorna = ['status' => false, 
                    'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Erro! Nenhum Usuário encontrado.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                        </button>
                    </div>"];
    }
    
}

echo json_encode($retorna);
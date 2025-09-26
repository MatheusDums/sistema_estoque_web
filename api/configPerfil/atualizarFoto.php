<?php
session_start();
require_once '../config/conector.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['id'])) {
    $retorna = ['status' => false, 'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Erro! Nenhum ID informado. Tente novamente mais tarde.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"];
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
        $editar = $conn->prepare("UPDATE usuarios SET imagem=:imagem WHERE id = :id");
        $editar->bindParam(':imagem', $imagem);
        $editar->bindParam(':id', $dados['id']);
        if($editar->execute()) {
                $_SESSION['imagem'] = $imagem;  // Atualiza a sessão com a nova imagem
            $retorna = [
                'status' => true, 
                'message' => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Foto de Perfil Editada com Sucesso.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>",
                'imagem' => $imagem
            ];
        } else {
            $retorna = ['status' => false, 
                        'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Erro ao atualizar a foto.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>"];
        }
    } else {
        $retorna = ['status' => false, 
                    'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Nenhuma imagem enviada.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"];
    }
}

echo json_encode($retorna);
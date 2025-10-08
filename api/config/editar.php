<?php 
require_once './conector.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty($dados['id'])) {
    $retorna = ['status' => false, 'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Erro! Nenhum ID informado. Tente novamente mais tarde.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>"];
} elseif(empty($dados['nome']) || empty($dados['codigo']) 
   || empty($dados['valor']) || empty($dados['descricao'])) {
    $retorna = [
        "status" => false,
        "message" => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Preencha todos os campos!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>"
    ];
} else {
    if (isset($dados['quantidade']) && intval($dados['quantidade']) === 0) {
        $dados['disponivel'] = 'Não';
    } else {
        $dados['disponivel'] = 'Sim';
    }


    $imagem = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $pasta = __DIR__ . "/../../assets/arquivos/uploads/";
        $nomeArquivo = uniqid() . "-" . basename($_FILES['imagem']['name']);
        $caminho = $pasta . $nomeArquivo;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            $imagem = "assets/arquivos/uploads/" . $nomeArquivo;
        }
    }

    if ($imagem) {
        $editar = "UPDATE produtos 
                   SET nome=:nome, codigo=:codigo, imagem=:imagem, estoque=:estoque, quantidade=:quantidade, 
                       valor=:valor, categoria=:categoria, descricao=:descricao
                   WHERE id = :id";
    } else {
        $editar = "UPDATE produtos SET nome=:nome, codigo=:codigo, estoque=:estoque, quantidade=:quantidade, 
    valor=:valor, categoria=:categoria, descricao=:descricao WHERE id = :id";
    }
    $editar = $conn->prepare($editar);
    $editar->bindParam(':id', $dados['id']);
    $editar->bindParam(':nome', $dados['nome']);
    $editar->bindParam(':codigo', $dados['codigo']);
    if ($imagem) {
        $editar->bindParam(':imagem', $imagem);
    }
    $editar->bindParam(':estoque', $dados['disponivel']);
    $editar->bindParam(':quantidade', $dados['quantidade']);
    $editar->bindParam(':valor', $dados['valor']);
    $editar->bindParam(':categoria', $dados['categoria']);
    $editar->bindParam(':descricao', $dados['descricao']);
    $editar->execute();

    if($editar->execute()) {
        if (isset($dados['quantidade']) && intval($dados['quantidade']) < 3) {
            if (isset($dados['quantidade']) && intval($dados['quantidade'])  < 1) {
                $titulo = "Estoque Baixo";
                $mensagem = "O produto <b>" . $dados['nome'] . "</b> está <b>sem unidades em estoque</b>";
                $inserirNotificacao = $conn->prepare("INSERT INTO notificacoes (titulo, mensagem) VALUES (:titulo, :mensagem)");
                $inserirNotificacao->bindParam(':titulo', $titulo);
                $inserirNotificacao->bindParam(':mensagem', $mensagem);
                $inserirNotificacao->execute();
            } else {
                $titulo = "Estoque Baixo";
                $mensagem = "O produto <b>" . $dados['nome'] . "</b> está com estoque <b>baixo</b>. (" . $dados['quantidade'] . " unidades restantes).";
                $inserirNotificacao = $conn->prepare("INSERT INTO notificacoes (titulo, mensagem) VALUES (:titulo, :mensagem)");
                $inserirNotificacao->bindParam(':titulo', $titulo);
                $inserirNotificacao->bindParam(':mensagem', $mensagem);
                $inserirNotificacao->execute();
            }
            
        }


        $retorna = ['status' => true, 
                    'message' => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Dados do Produto <b>". $dados['nome'] . "</b> Editado com Sucesso.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>"];
    } else {
        $retorna = ['status' => false, 
                    'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Erro! Nenhum Produto encontrado.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                        </button>
                    </div>"];
    }
    
}

echo json_encode($retorna);

<?php
require './conector.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if(!empty($id)) {
    $delete = "DELETE FROM produtos WHERE id = :id";
    $delete_result = $conn->prepare($delete);
    $delete_result->bindParam(':id', $id);
    $delete_result->execute();
    if($delete_result->rowCount()) {
         $retorna = ['status' => true, 
                     'message' => "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                         Produto Excluído com Sucesso.
                         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                     </div>"];
    } else {
         $retorna = ['status' => false, 
                     'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                         Erro ao Excluir Produto. Nenhum registro encontrado.
                         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                     </div>"];
    }
} else {
    $retorna = ['status' => false, 
                    'message' => "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Erro ao Excluir Produto.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                        </button>
                    </div>"];
}

echo json_encode($retorna);
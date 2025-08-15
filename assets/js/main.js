$(document).ready(function () {
    $("#tabela").DataTable({
        columnDefs: [{
            targets: "_all",
            className: "text-center",
            createdCell: function (td) {
                $(td).css("text-align", "center");
            }
        }],
        processing: true,
        serverSide: true,
        language: {
            url: "./assets/json/traducao.json"
        },
        ajax: "api/config/listar.php",
    });      
});


// cadastrar produtos
    const new_product = document.getElementById("form_cadastro");

    if (new_product) {
        new_product.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dadosForm = new FormData(new_product);

          const dadosCadastro = await fetch("api/config/cadastrar.php", {
            method: "POST",
            body: dadosForm
          });

          console.log(dadosCadastro);

          const resposta = await dadosCadastro.json();
          console.log(resposta);

          if(resposta['status']){
            history.replaceState(null, null, window.location.href);
            document.getElementById("msgAlertErroListar").innerHTML = resposta['message'];
            $('#modal_cadastrar').modal('hide');
            new_product.reset();
            listarDataTable = $("#tabela").DataTable();
            listarDataTable.ajax.reload(null, false);
            setTimeout(() => {
              document.getElementById("msgAlertErroListar").innerHTML = "";
            }, 5000);
          } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['message'];
            setTimeout(() => {
              document.getElementById("msgAlertErroCad").innerHTML = "";
            }, 5000);
          }

        });
    }

/* detalhes - modal */
async function visUser(id) {
  const dados = await fetch('api/config/visualizar.php?id=' + id);
  const respostaVisualizar = await dados.json();

  if (respostaVisualizar['status']) {
    const visModal = new bootstrap.Modal(document.getElementById('visUserModal'));
    visModal.show();
    document.getElementById("nome").innerHTML = respostaVisualizar['dados'].nome;
    document.getElementById("codigo").innerHTML = respostaVisualizar['dados'].codigo
    document.getElementById("estoque").innerHTML = respostaVisualizar['dados'].estoque;
    document.getElementById("quantidade").innerHTML = respostaVisualizar['dados'].quantidade;
    document.getElementById("valor").innerHTML = respostaVisualizar['dados'].valor
    document.getElementById("categoria").innerHTML = respostaVisualizar['dados'].categoria;
    document.getElementById("descricao").innerHTML = respostaVisualizar['dados'].descricao

  } else {
    document.getElementById("msgAlertErroListar").innerHTML = respostaVisualizar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertErroListar").innerHTML = "";
            }, 5000);
  }

}

/* editar - modal */
const editModal = new bootstrap.Modal(document.getElementById('editModal'));
async function editUser(id) {
  const dados = await fetch('api/config/visualizar.php?id=' + id);
  const respostaEditar = await dados.json();
  console.log(respostaEditar);

  if (respostaEditar['status']) {
    editModal.show();
    document.getElementById("edit_id").value = respostaEditar['dados'].id;
    document.getElementById("edit_nome").value = respostaEditar['dados'].nome;
    document.getElementById("edit_codigo").value = respostaEditar['dados'].codigo
    document.getElementById("edit_estoque").value = respostaEditar['dados'].estoque;
    document.getElementById("edit_quantidade").value = respostaEditar['dados'].quantidade;
    document.getElementById("edit_valor").value = respostaEditar['dados'].valor
    document.getElementById("edit_categoria").value = respostaEditar['dados'].categoria;
    document.getElementById("edit_descricao").value = respostaEditar['dados'].descricao
  } else {
    document.getElementById("msgAlertErroListar").innerHTML = respostaEditar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertErroListar").innerHTML = "";
            }, 5000);
  }

}

const formEditUser = document.getElementById("form_editar");
if (formEditUser) {
  formEditUser.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(formEditUser);
    const dados = await fetch("api/config/editar.php", {
      method: "POST",
      body: dadosForm
    });

    const resposta = await dados.json();
    if(resposta['status']) {
      history.replaceState(null, null, window.location.href);
      $('#editModal').modal('hide');
      document.getElementById("msgAlertErroListar").innerHTML = resposta['message'];
      listarDataTable = $("#tabela").DataTable();
      listarDataTable.ajax.reload(null, false);
      setTimeout(() => {
        document.getElementById("msgAlertErroListar").innerHTML = "";
      }, 5000);
    } else {
      document.getElementById("msgAlertErroEdit").innerHTML = resposta['message'];
      setTimeout(() => {
        document.getElementById("msgAlertErroEdit").innerHTML = "";
      }, 5000);
    }
  })
}

async function deleteUser(id) {

  var confirmar = confirm("Deseja excluir este produto?");
  if (confirmar) {
    const dados = await fetch('api/config/apagar.php?id=' + id);
    const respostaDeletar = await dados.json();
    
    if(respostaDeletar['status']) {
      listarDataTable = $("#tabela").DataTable();
      listarDataTable.draw();
      document.getElementById("msgAlertErroListar").innerHTML = respostaDeletar['message'];
      setTimeout(() => {
        document.getElementById("msgAlertErroListar").innerHTML = "";
      }, 5000);
      } else {
        document.getElementById("msgAlertErroListar").innerHTML = respostaDeletar['message'];
        setTimeout(() => {
          document.getElementById("msgAlertErroListar").innerHTML = "";
        }, 5000);
    }
  }
}
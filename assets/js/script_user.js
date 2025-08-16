const inputSenha = document.getElementById('inputSenha');
const visivel = document.getElementById('toggleSenha');
const visivelEdit = document.getElementById('toggleSenhaEdit');

visivel.addEventListener('click', () => {
    if (inputSenha.type === 'password') {
        inputSenha.type = 'text';
    } else {
        inputSenha.type = 'password';
    }
})

visivelEdit.addEventListener('click', () => {
    const inputSenhaEdit = document.getElementById('edit_senha_user');
    if (inputSenhaEdit.type === 'password') {
        inputSenhaEdit.type = 'text';
    } else {
        inputSenhaEdit.type = 'password';
    }
})

$(document).ready(function () {
    $("#tabela_usuarios").DataTable({
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
            url: "../json/traducao.json"
        },
        ajax: "../../api/configUsers/listarUsers.php",
    });   
});


// cadastrar produtos
    const new_user = document.getElementById("form_cadastro_user");

    if (new_user) {
        new_user.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dadosForm = new FormData(new_user);

          const dadosUser = await fetch("../../api/configUsers/cadastrarUsers.php", {
            method: "POST",
            body: dadosForm
          });

          console.log(dadosUser);

          const resposta = await dadosUser.json();
          console.log(resposta);

          if(resposta['status']){
            history.replaceState(null, null, window.location.href);
            document.getElementById("msgAlertusuarios").innerHTML = resposta['message'];
            $('#modal_cadastrar_users').modal('hide');
            new_user.reset();
            listarDataTable = $("#tabela_usuarios").DataTable();
            listarDataTable.ajax.reload(null, false);
            setTimeout(() => {
              document.getElementById("msgAlertusuarios").innerHTML = "";
            }, 5000);
          } else {
            document.getElementById("msgAlertErroUsers").innerHTML = resposta['message'];
            setTimeout(() => {
              document.getElementById("msgAlertErroUsers").innerHTML = "";
            }, 5000);
          }

        });
    }

/* detalhes - modal */
async function visUser(id) {
  const dados = await fetch('../../api/configUsers/visualizarUsers.php?id=' + id);
  const respostaVisualizar = await dados.json();

  if (respostaVisualizar['status']) {
    const visModal = new bootstrap.Modal(document.getElementById('visUserModalUsuarios'));
    visModal.show();
    document.getElementById("cadastro").innerHTML = respostaVisualizar['dados'].cadastro;
    document.getElementById("nome").innerHTML = respostaVisualizar['dados'].nome;
    document.getElementById("usuario").innerHTML = respostaVisualizar['dados'].user;
    document.getElementById("senha").innerHTML = '********';
    document.getElementById("email").innerHTML = respostaVisualizar['dados'].email
    document.getElementById("telefone").innerHTML = respostaVisualizar['dados'].telefone;
    document.getElementById("cargo").innerHTML = respostaVisualizar['dados'].cargo;

  } else {
    document.getElementById("msgAlertusuarios").innerHTML = respostaVisualizar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertusuarios").innerHTML = "";
            }, 5000);
  }

}

/* editar - modal */
const editModal = new bootstrap.Modal(document.getElementById('editModalUser'));
async function editUser(id) {
  const dados = await fetch('../../api/configUsers/visualizarUsers.php?id=' + id);
  const respostaEditar = await dados.json();
  console.log(respostaEditar);

  if (respostaEditar['status']) {
    editModal.show();
    document.getElementById("edit_id_user").value = respostaEditar['dados'].id;
    document.getElementById("edit_nome_user").value = respostaEditar['dados'].nome;
    document.getElementById("edit_usuario_user").value = respostaEditar['dados'].user;
    document.getElementById("edit_senha_user").value = respostaEditar['dados'].senha;
    document.getElementById("edit_email_user").value = respostaEditar['dados'].email;
    document.getElementById("edit_telefone_user").value = respostaEditar['dados'].telefone
    document.getElementById("edit_cargo_user").value = respostaEditar['dados'].cargo;
    document.getElementById("edit_cadastro_user").value = respostaEditar['dados'].cadastro
  } else {
    document.getElementById("msgAlertusuarios").innerHTML = respostaEditar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertusuarios").innerHTML = "";
            }, 5000);
  }

}

const formEditUser = document.getElementById("form_editar");
if (formEditUser) {
  formEditUser.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(formEditUser);
    const dados = await fetch("../../api/configUsers/editarUsers.php", {
      method: "POST",
      body: dadosForm
    });

    const resposta = await dados.json();
    if(resposta['status']) {
      history.replaceState(null, null, window.location.href);
      $('#editModalUser').modal('hide');
      document.getElementById("msgAlertusuarios").innerHTML = resposta['message'];
      listarDataTable = $("#tabela_usuarios").DataTable();
      listarDataTable.ajax.reload(null, false);
      setTimeout(() => {
        document.getElementById("msgAlertusuarios").innerHTML = "";
      }, 5000);
    } else {
      document.getElementById("msgAlertErroUsersEditar").innerHTML = resposta['message'];
      setTimeout(() => {
        document.getElementById("msgAlertErroUsersEditar").innerHTML = "";
      }, 5000);
    }
  })
}

/* excluir user */
async function deleteUser(id) {

  var confirmar = confirm("Deseja excluir este Usuário?");
  if (confirmar) {
    const dados = await fetch('../../api/configUsers/excluirUsers.php?id=' + id);
    const respostaDeletar = await dados.json();
    
    if(respostaDeletar['status']) {
      listarDataTable = $("#tabela_usuarios").DataTable();
      listarDataTable.draw();
      document.getElementById("msgAlertusuarios").innerHTML = respostaDeletar['message'];
      setTimeout(() => {
        document.getElementById("msgAlertusuarios").innerHTML = "";
      }, 5000);
      } else {
        document.getElementById("msgAlertusuarios").innerHTML = respostaDeletar['message'];
        setTimeout(() => {
          document.getElementById("msgAlertusuarios").innerHTML = "";
        }, 5000);
    }
  }
}
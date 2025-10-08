$(document).ready(function () {
    $("#tabela_sugestoes").DataTable({
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
            url: "../assets/json/traducao.json"
        },
        ajax: "../api/configAdmin/listarSug.php",
    });   
});

/* parte de help */

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
            url: "../assets/json/traducao.json"
        },
        ajax: "../api/configAdmin/listarHelps.php",
    });   
});

/* detalhes - modal */
async function visHelp(id) {
  const dados = await fetch('../api/configAdmin/visualizarHelps.php?id=' + id);
  const respostaVisualizar = await dados.json();
  document.getElementById("id_help").dataset.id = respostaVisualizar['dados'].id_help;
  document.getElementById("status-modal").value = respostaVisualizar['dados'].status_help;


  if (respostaVisualizar['status']) {
    const visModal = new bootstrap.Modal(document.getElementById('visUserModalHelp'));
    visModal.show();
    document.getElementById("id_help").innerHTML = '#' + respostaVisualizar['dados'].id_help;
    document.getElementById("nome_modal").innerHTML = respostaVisualizar['dados'].user;
    document.getElementById("assunto_modal").innerHTML = respostaVisualizar['dados'].assunto;
    document.getElementById("area_modal").innerHTML = respostaVisualizar['dados'].area;
    document.getElementById("nivel_modal").innerHTML = respostaVisualizar['dados'].nivel;
    document.getElementById("status_modal").innerHTML = respostaVisualizar['dados'].status_help;
    document.getElementById("descricao_modal").innerHTML = respostaVisualizar['dados'].descricao;
    let caminhoImagem = respostaVisualizar['dados'].imagem.substring(3);
    let caminhoImagemOk= `../assets/${caminhoImagem}`;
    document.getElementById("imgHelp").src = caminhoImagemOk;
    document.getElementById("contato_modal").innerHTML = respostaVisualizar['dados'].contato;

  } else {
    document.getElementById("msgAlertHelp").innerHTML = respostaVisualizar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertHelp").innerHTML = "";
            }, 5000);
  }

}
document.addEventListener("change", async function (e) {
  if (e.target && e.target.id === "status-modal") {
    let id_help = document.getElementById("id_help").dataset.id;
    let status = e.target.value;

    const formData = new FormData();
    formData.append("id_help", id_help);
    formData.append("status", status);

    const resposta = await fetch("../api/configAdmin/atualizarStatusHelp.php", {
      method: "POST",
      body: formData
    });

    const dados = await resposta.json();

    if (dados.status) {
      document.getElementById("msgAlertHelp").innerHTML = 
        `<div class="alert alert-success">${dados.message}</div>`;
      $("#tabela").DataTable().ajax.reload(null, false);
    } else {
      document.getElementById("msgAlertHelp").innerHTML = 
        `<div class="alert alert-danger">${dados.message}</div>`;
    }

    setTimeout(() => {
      document.getElementById("msgAlertHelp").innerHTML = "";
    }, 4000);
  }
});

/* parte de recados */

const new_product = document.getElementById("form-recados");

    if (new_product) {
        new_product.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dadosForm = new FormData(new_product);

          const dadosCadastro = await fetch("../api/configAdmin/acoesRecados.php", {
            method: "POST",
            body: dadosForm
          });

          console.log(dadosCadastro);

          const resposta = await dadosCadastro.json();
          console.log(resposta);

          if(resposta['status']){
            history.replaceState(null, null, window.location.href);
            document.querySelector(".AlertRecados").innerHTML = 
              `<div class="alert alert-success">${resposta['message']}</div>`;
            new_product.reset();
            setTimeout(() => {
              document.querySelector(".AlertRecados").innerHTML = "";
            }, 5000);
          } else {
            document.querySelector(".AlertRecados").innerHTML = 
              `<div class="alert alert-danger">${resposta['message']}</div>`;
            setTimeout(() => {
              document.querySelector(".AlertRecados").innerHTML = "";
            }, 5000);
          }

        });
    }

    $(document).ready(function () {
        // Clique no botão de excluir
        $(document).on("click", ".btn-excluir-recado", function () {
            let id = $(this).data("id");
            let botao = $(this);

            if (confirm("Tem certeza que deseja excluir este recado?")) {
                $.ajax({
                    url: "../api/configAdmin/excluirRecado.php",
                    method: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            // Remove o recado do HTML sem recarregar a página
                            botao.closest(".recados-content").remove();
                            document.querySelector(".AlertRecados").innerHTML = 
                              `<div class="alert alert-success">${response.message}'</div>`;
                            setTimeout(() => {
                              document.querySelector(".AlertRecados").innerHTML = "";
                            }, 5000);
                        }
                    },
                    error: function () {
                        alert("Erro na requisição. Tente novamente.");
                    }
                });
            }
        });
    });

/* parte de usuarios */

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
            url: "../assets/json/traducao.json"
        },
        ajax: "../api/configUsers/listarUsers.php",
    });   
});


// cadastrar usuario
    const new_user = document.getElementById("form_cadastro_user");

    if (new_user) {
        new_user.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dadosForm = new FormData(new_user);

          const dadosUser = await fetch("../api/configUsers/cadastrarUsers.php", {
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
  const dados = await fetch('../api/configUsers/visualizarUsers.php?id=' + id);
  const respostaVisualizar = await dados.json();

  if (respostaVisualizar['status']) {
    const visModal = new bootstrap.Modal(document.getElementById('visUserModalUsuarios'));
    visModal.show();
    document.getElementById("cadastro").innerHTML = respostaVisualizar['dados'].cadastro;
    document.getElementById("nome").innerHTML = respostaVisualizar['dados'].nome;
    let caminhoImagem = respostaVisualizar['dados'].imagem.substring(3);
    let caminhoImagemOk= `../assets/${caminhoImagem}`;
    document.getElementById("imgUsers").src = caminhoImagemOk;
    document.getElementById("usuario").innerHTML = respostaVisualizar['dados'].user;
    document.getElementById("senha").innerHTML = '********';
    document.getElementById("email").innerHTML = respostaVisualizar['dados'].email
    document.getElementById("telefone").innerHTML = respostaVisualizar['dados'].telefone;
    document.getElementById("cargo").innerHTML = respostaVisualizar['dados'].cargo;
    document.getElementById("empresa").innerHTML = respostaVisualizar['dados'].empresa;

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
  const dados = await fetch('../api/configUsers/visualizarUsers.php?id=' + id);
  const respostaEditar = await dados.json();
  console.log(respostaEditar);

  if (respostaEditar['status']) {
    editModal.show();
    document.getElementById("edit_id_user").value = respostaEditar['dados'].id;
    document.getElementById("edit_nome_user").value = respostaEditar['dados'].nome;
    document.getElementById("edit_usuario_user").value = respostaEditar['dados'].user;
    document.getElementById("edit_senha_user").value = respostaEditar['dados'].senha;
    document.getElementById("edit_email_user").value = respostaEditar['dados'].email;
    document.getElementById("edit_telefone_user").value = respostaEditar['dados'].telefone;
    document.getElementById("edit_cargo_user").value = respostaEditar['dados'].cargo;
    document.getElementById("edit_cadastro_user").value = respostaEditar['dados'].cadastro;

    const preview = document.getElementById("edit_img_preview");

    if (respostaEditar['dados'].imagem && respostaEditar['dados'].imagem !== "") {
        let caminhoImagem = respostaEditar['dados'].imagem.replace(/^(\.\.\/)+/, '');
        preview.src = `../assets/${caminhoImagem}`;
    } else {
        preview.src = "../assets/arquivos/uploadsUsers/default.png";
    }

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
    const dados = await fetch("../api/configUsers/editarUsers.php", {
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
    const dados = await fetch('../api/configUsers/excluirUsers.php?id=' + id);
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
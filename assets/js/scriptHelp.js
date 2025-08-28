let form_help = document.querySelector('.help_form');
let botao = document.getElementById('botao_mostrar');

function mostrarForm() {
    if(form_help.classList.contains('hideForm')){
        form_help.classList.remove('hideForm');
        botao.textContent = 'Fechar Formulário';
    } else {
        form_help.classList.add('hideForm');
        botao.textContent = 'Adicionar Chamado';
    }
}

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
            url: "../json/traducao.json"
        },
        ajax: "../../api/configHelp/listarHelps.php",
    });   
});

// cadastrar Help
    const new_user = document.getElementById("form_cadastro_help");

    if (new_user) {
        new_user.addEventListener("submit", async (e) => {
            e.preventDefault();
            const dadosForm = new FormData(new_user);

          const dadosUser = await fetch("../../api/configHelp/adicionarHelps.php", {
            method: "POST",
            body: dadosForm
          });

          console.log(dadosUser);

          const resposta = await dadosUser.json();
          console.log(resposta);

          if(resposta['status']){
            history.replaceState(null, null, window.location.href);
            document.getElementById("msgAlertHelp").innerHTML = resposta['message'];
            new_user.reset();
            listarDataTable = $("#tabela").DataTable();
            listarDataTable.ajax.reload(null, false);
            form_help.classList.add('hideForm');
            botao.textContent = 'Adicionar Chamado';
            setTimeout(() => {
              document.getElementById("msgAlertHelp").innerHTML = "";
            }, 5000);
          } else {
            document.getElementById("msgAlertHelp").innerHTML = resposta['message'];
            setTimeout(() => {
              document.getElementById("msgAlertHelp").innerHTML = "";
            }, 5000);
          }

        });
    }

/* detalhes - modal */
async function visUser(id) {
  const dados = await fetch('../../api/configHelp/visualizarHelps.php?id=' + id);
  const respostaVisualizar = await dados.json();

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
    document.getElementById("imgHelp").src = respostaVisualizar['dados'].imagem;
    document.getElementById("contato_modal").innerHTML = respostaVisualizar['dados'].contato;

  } else {
    document.getElementById("msgAlertHelp").innerHTML = respostaVisualizar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertHelp").innerHTML = "";
            }, 5000);
  }

}

/* notificações */

$(document).ready(function () {
    function atualizarBadge() {
        $.ajax({
            url: "../../api/configNot/listar.php", // sobe 1 nível
            method: "GET",
            dataType: "json",
            success: function (data) {
                const naoLidas = Array.isArray(data) ? data.filter(n => n.lida == 0).length : 0;
                const $badge = $(".notification-badge");

                if (naoLidas > 0) {
                    $badge.removeClass("hiddenBadge");
                } else {
                    $badge.addClass("hiddenBadge");
                }
            }
        });
    }

    atualizarBadge();
    setInterval(atualizarBadge, 30000);
});

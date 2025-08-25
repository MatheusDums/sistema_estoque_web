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

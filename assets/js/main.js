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
            }, 4000);
          } else {
            document.getElementById("msgAlertErroCad").innerHTML = resposta['message'];
            setTimeout(() => {
              document.getElementById("msgAlertErroCad").innerHTML = "";
            }, 4000);
          }

        });
    }

/* detalhes - modal */
async function visUser(id) {
  /* console.log(id); */
  const dados = await fetch('api/config/visualizar.php?id=' + id);
  const respostaVisualizar = await dados.json();
  console.log(respostaVisualizar);

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
            }, 4000);
  }

}
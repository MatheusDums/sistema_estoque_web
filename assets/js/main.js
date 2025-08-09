$(document).ready(function () {
  $("#tabela").DataTable({
    columnDefs: [
      {
        targets: "_all",
        className: "text-center",
        createdCell: function (td) {
          $(td).css("text-align", "center");
        },
      },
    ],
    processing: true,
    serverSide: true,
    language: {
      url: "./assets/json/traducao.json"
    },
    ajax: "api/config/listar.php",
  });
});
    

/* cadastrar produtos */
const new_product = document.getElementById("form_cadastro")
console.log("teste");


if (new_product) {
    new_product.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dadosForm = new FormData(new_product);
        console.log(dadosForm);
    })

}
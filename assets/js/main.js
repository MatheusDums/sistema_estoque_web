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
    
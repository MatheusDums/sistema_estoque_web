$(document).ready(function () {
    // --- Badge de notificações ---
    function atualizarBadge() {
        $.ajax({
            url: "../../api/configNot/listar.php",
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

    // --- Parte de sugestões ---
    $("#form-sugestoes").on("submit", function (e) {
        e.preventDefault();

        if (!$("#checkbox_aceito").is(":checked")) {
            document.getElementById("campoAlertaSugestoes").innerHTML =
                "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Aceite o checkbox de envio!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            setTimeout(() => {
                document.getElementById("campoAlertaSugestoes").innerHTML = "";
            }, 5000);
            return;
        }

        $.ajax({
            url: "../../api/configImpl/implementacoes.php",
            method: "POST",
            data: {
                nome: $("#nome").val(),
                email: $("#email").val(),
                empresa: $("#empresa").val(),
                area: $("#area").val(),
                mensagem: $("#mensagem").val()
            },
            dataType: "json",
            success: function (resposta) {
                // Mostra SEMPRE a mensagem vinda do PHP
                document.getElementById("campoAlertaSugestoes").innerHTML = resposta['message'];

                if (resposta.status) {
                    $("#form-sugestoes")[0].reset();
                }

                setTimeout(() => {
                    document.getElementById("campoAlertaSugestoes").innerHTML = "";
                }, 5000);
            },
            error: function () {
                document.getElementById("campoAlertaSugestoes").innerHTML =
                    "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Erro inesperado na requisição.<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
            }
        });
    });
});

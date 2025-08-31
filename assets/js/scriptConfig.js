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

// Preencher dados da empresa e usuários via AJAX
$(document).ready(function() {
    $.ajax({
        url: '../../api/configSettings/dadosConfig.php',
        method: 'GET',
        dataType: 'json',
        success: function(dados) {
            if (dados) {
                $("#infos .dado p:contains('Nome da Empresa')").html('<b>Nome da Empresa: </b>' + (dados.nome || '-'));
                $("#infos .dado p:contains('Endereço')").html('<b>Endereço: </b>' + (dados.endereco || '-'));
                $("#infos .dado p:contains('Telefone')").html('<b>Telefone: </b>' + (dados.telefone || '-'));
                $("#infos .dado p:contains('Email')").html('<b>Email: </b>' + (dados.email || '-'));
                $("#infos .dado p:contains('Usuários do Sistema')").html('<b>Usuários do Sistema: </b>' + (dados.totalUsuarios || '0'));
            }
        },
        error: function() {
            $("#infos .dado p:contains('Nome da Empresa')").html('<b>Nome da Empresa: </b>Erro ao carregar');
        }
    });
});
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

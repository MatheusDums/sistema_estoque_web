$(document).ready(function () {

    // ====== util ======
    function tempoRelativo(dataNotificacao) {
        const agora = new Date();
        const notiDate = new Date(dataNotificacao);
        const diff = agora - notiDate;

        const segundos = Math.floor(diff / 1000);
        const minutos = Math.floor(segundos / 60);
        const horas   = Math.floor(minutos / 60);
        const dias    = Math.floor(horas / 24);

        if (segundos < 60) return `há ${segundos}s`;
        if (minutos  < 60) return `há ${minutos}m`;
        if (horas    < 24) return `há ${horas}h`;
        return `há ${dias}d`;
    }

    const $badge = $("#notificationBadge");

    function atualizarBadge(qtdNaoLidas) {
        if (qtdNaoLidas > 0) {
            $badge.text(qtdNaoLidas).removeClass("hiddenBadge");
        } else {
            $badge.text("").addClass("hiddenBadge");
        }
    }

    function atualizarBadgeAPartirDoDOM() {
        const naoLidas = $(".notification-item.alert-warning").length;
        atualizarBadge(naoLidas);
    }

    // ====== carregar ======
    function carregarNotificacoes() {
        $.ajax({
            url: "../../api/configNot/listar.php",
            method: "GET",
            dataType: "json",
            success: function (data) {
                let feed = $("#notifications-feed");
                feed.empty();

                let notificationBadge = $("#notificationBadge");

                if (data.length === 0) {
                    feed.append('<div class="alert alert-info">Nenhuma notificação encontrada.</div>');
                    notificationBadge.addClass("hiddenBadge");
                } else {
                    let naoLidas = data.filter(n => n.lida == 0).length;

                    if (naoLidas > 0) {
                        notificationBadge.removeClass("hiddenBadge"); // mostra badge
                    } else {
                        notificationBadge.addClass("hiddenBadge"); // esconde badge
                    }

                    data.forEach(function (n) {
                        let classe = n.lida == 0 ? "alert-warning" : "alert-secondary";

                        let card = `
                            <div class="alert ${classe} notification-item" data-id="${n.id}" style="cursor: pointer;">
                                <strong style="font-size: 1.5rem; display: block; margin-bottom: 0.5rem;"> 🔔 ${n.titulo}</strong>
                                <span style="display: block; margin-bottom: 0.5rem; font-size: 1rem;">${n.mensagem}.</span>
                                <small class="text-muted" style="display: block; margin-top: 1rem;"> 🕔 ${tempoRelativo(n.criada_em)}</small>
                            </div>
                        `;
                        feed.append(card);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error("Erro ao carregar notificações:", error);
            }
        });
    }

    // ====== clique: marcar como lida ======
    $("#notifications-feed").on("click", ".notification-item", function () {
        const $item = $(this);
        const id = $item.data("id");

        if ($item.hasClass("alert-warning")) {
            $item.removeClass("alert-warning").addClass("alert-secondary");
            atualizarBadgeAPartirDoDOM();
        }

        $.ajax({
            url: "../../api/configNot/marcarLida.php",
            method: "POST",
            data: { id },
            success: function (res) {
                try {
                    const r = typeof res === "object" ? res : JSON.parse(res);
                    if (!r.status) {
                        console.error("Erro ao marcar como lida:", r.msg);
                    }
                } catch (e) {
                    console.error("Resposta inválida do servidor:", res);
                }
            }
        });
    });

    /* Ler todas as Notificações */
    const NotifMessages = document.querySelector('.NotifMessages');
    window.readNotifications = function() {
        $.ajax({
            url: "../../api/configNot/lerTodas.php",
            method: "POST",
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    $(".notification-item.alert-warning").removeClass("alert-warning").addClass("alert-secondary");
                    $("#notificationBadge").addClass("hiddenBadge").text("");

                    atualizarBadge(0);

                    if (NotifMessages) {
                        NotifMessages.innerHTML = `<hr><div class="alert alert-success">${r.msg}</div>`;
                        setTimeout(() => {
                            NotifMessages.innerHTML = "";
                        }, 5000);
                    }

                    carregarNotificacoes();
                } else {
                    if (NotifMessages) {
                        NotifMessages.innerHTML = `<hr><div class="alert alert-danger">${r.msg}</div>`;
                        setTimeout(() => {
                            NotifMessages.innerHTML = "";
                        }, 5000);
                    }
                }
            },
            error: function(error) {
                console.error("Erro na requisição AJAX:", error);
                if (NotifMessages) {
                    NotifMessages.innerHTML = `<hr><div class="alert alert-danger">Erro ao comunicar com o servidor.</div>`;
                    setTimeout(() => {
                        NotifMessages.innerHTML = "";
                    }, 5000);
                }
            }
        });
    }

    window.deleteNotifications = function() {
        $.ajax({
            url: "../../api/configNot/apagarTodas.php",
            method: "POST",
            dataType: "json",
            success: function (r) {
                if (r.status) {
                    $(".notification-item.alert-warning").removeClass("alert-warning").addClass("alert-secondary");
                    $("#notificationBadge").addClass("hiddenBadge").text("");

                    atualizarBadge(0);

                    if (NotifMessages) {
                        NotifMessages.innerHTML = `<hr><div class="alert alert-success">${r.msg}</div>`;
                        setTimeout(() => {
                            NotifMessages.innerHTML = "";
                        }, 5000);
                    }

                    carregarNotificacoes();
                } else {
                    if (NotifMessages) {
                        NotifMessages.innerHTML = `<hr><div class="alert alert-danger">${r.msg}</div>`;
                        setTimeout(() => {
                            NotifMessages.innerHTML = "";
                        }, 5000);
                    }
                }
            },
            error: function(error) {
                console.error("Erro na requisição AJAX:", error);
                if (NotifMessages) {
                    NotifMessages.innerHTML = `<hr><div class="alert alert-danger">Erro ao comunicar com o servidor.</div>`;
                    setTimeout(() => {
                        NotifMessages.innerHTML = "";
                    }, 5000);
                }
            }
        });
    }

    carregarNotificacoes();
    setInterval(carregarNotificacoes, 30000);
});

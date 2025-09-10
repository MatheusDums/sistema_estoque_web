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

/* atualizar senha */

$(document).ready(function () {
    $('#toggleSenhaEdit').on('click', function () {
        const $senhaInput = $('#edit_senha_user');
        const type = $senhaInput.attr('type') === 'password' ? 'text' : 'password';
        $senhaInput.attr('type', type);
        $(this).find('i').toggleClass('bi-eye bi-eye-slash');
    })
    $('#toggleSenhaEdit2').on('click', function () {
        const $senhaInput = $('#edit_senha');
        const type = $senhaInput.attr('type') === 'password' ? 'text' : 'password';
        $senhaInput.attr('type', type);
        $(this).find('i').toggleClass('bi-eye bi-eye-slash');
    })
});
/* $(document).ready(function () {
    $('#ModalAlterarSenha .btn-primary').on('click', function () {
        const novaSenha = $('#edit_senha').val();
        const idUsuario = <?php echo json_encode($resultado['id']) ?>;

        if (!novaSenha) {
            alert('Digite a nova senha.');
            return;
        }

        $.ajax({
            url: "../../api/configPerfil/atualizarSenha.php",
            method: "POST",
            data: { id: idUsuario, senha: novaSenha },
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    alert('Senha atualizada com sucesso!');
                    $('#ModalAlterarSenha').modal('hide');
                    $('#edit_senha').val('');
                } else {
                    alert('Erro: ' + (res.error || 'Não foi possível atualizar a senha.'));
                }
            }
        });
    });
}); */
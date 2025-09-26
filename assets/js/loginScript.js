$(document).ready(function () {
    $('#toggleSenha').on('click', function () {
        const input = $('#password');
        const icon = $(this).find('i');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });
});

// Função para verificar os campos e atualizar o botão
function verificarCampos() {
    const userInput = $('#username');
    const passwordInput = $('#password');
    const submitBtn = $('button[type="submit"]');
    
    if (userInput.val() && passwordInput.val()) {
        submitBtn.removeClass('btn-secondary').addClass('btn-primary');
    } else {
        submitBtn.removeClass('btn-primary').addClass('btn-secondary');
    }
}

// Verificar quando digitar em qualquer campo
$('#username, #password').on('input', function() {
    verificarCampos();
});
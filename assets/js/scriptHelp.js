

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

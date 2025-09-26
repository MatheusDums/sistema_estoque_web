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
    // Handler para o botão de toggle da senha antiga
    $('#toggleSenhaEdit').on('click', function (e) {
        e.preventDefault();
        const senhaInput = document.getElementById('edit_senha_user');
        if (senhaInput.type === 'password') {
            senhaInput.type = 'text';
            $(this).find('i').removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            senhaInput.type = 'password';
            $(this).find('i').removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });

    // Handler para o botão de toggle da nova senha
    $('#toggleSenhaEdit2').on('click', function (e) {
        e.preventDefault();
        const senhaInput = document.getElementById('edit_senha');
        if (senhaInput.type === 'password') {
            senhaInput.type = 'text';
            $(this).find('i').removeClass('bi-eye').addClass('bi-eye-slash');
        } else {
            senhaInput.type = 'password';
            $(this).find('i').removeClass('bi-eye-slash').addClass('bi-eye');
        }
    });
});
/* atualizar senha pela nova */
async function editUser(id) {
  const dados = await fetch('../../api/configPeril/atualizarSenha.php?id=' + id);
  const respostaEditar = await dados.json();
  console.log(respostaEditar);

  if (respostaEditar['status']) {
    editModal.show();
    document.getElementById("edit_senha").value = respostaEditar['dados'].senha;
  } else {
    document.getElementById("msgAlertBody").innerHTML = respostaEditar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertBody").innerHTML = "";
            }, 5000);
  }
}


const formEditUser = document.getElementById("ModalAlterarSenha");
if (formEditUser) {
  formEditUser.addEventListener("submit", async (e) => {
    e.preventDefault();
    const dadosForm = new FormData(formEditUser);
    const dados = await fetch("../../api/configPerfil/atualizarSenha.php", {
      method: "POST",
      body: dadosForm
    });

    const resposta = await dados.json();
    if(resposta['status']) {
        // Fechar o modal de senha
        const modalElement = formEditUser.closest('.modal');
        const modalInstance = bootstrap.Modal.getInstance(modalElement);
        if (modalInstance) modalInstance.hide();
        // Exibir mensagem de sucesso no topo da tela
        document.getElementById("msgAlertBody").innerHTML = resposta['message'];
        setTimeout(() => {
            document.getElementById("msgAlertBody").innerHTML = "";
        }, 5000);

            // Limpar campo de senha
    document.getElementById("edit_senha").value = "";
    } else {
        document.getElementById("textMsgSenha").innerHTML = resposta['message'];
        setTimeout(() => {
            document.getElementById("textMsgSenha").innerHTML = "";
        }, 5000);
    }
  })
}


/* código movido para cima */



/* atualizar Foto de perfil pela nova */
async function editUser(id) {
  const dados = await fetch('../../api/configPeril/atualizarFoto.php?id=' + id);
  const respostaEditar = await dados.json();
  console.log(respostaEditar);

  if (respostaEditar['status']) {
    editModal.show();
    document.getElementById("edit_senha").value = respostaEditar['dados'].senha;
  } else {
    document.getElementById("msgAlertBody").innerHTML = respostaEditar['message'];
    setTimeout(() => {
              document.getElementById("msgAlertBody").innerHTML = "";
            }, 5000);
  }
}


// Atualizar foto de perfil via AJAX
const formFoto = document.getElementById("formAlterarFoto");
if (formFoto) {
    // Preview da imagem antes do upload
    const inputImagem = formFoto.querySelector("#edit_imagem");
    const imgPreview = formFoto.querySelector("#imgPreview");
    inputImagem.addEventListener("change", function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                imgPreview.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    formFoto.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(formFoto);
        const response = await fetch("../../api/configPerfil/atualizarFoto.php", {
            method: "POST",
            body: formData
        });
        const result = await response.json();
        document.getElementById("textMsgFoto").innerHTML = result.message;
        if (result.status) {
            // Atualiza a foto de perfil em todos os lugares da página
            if (result.imagem) {
                // Atualiza todas as imagens de perfil na página
                const imgElements = document.querySelectorAll("img[src*='uploadsUsers']");
                imgElements.forEach(img => {
                    img.src = result.imagem;
                });
            }
            // Fecha o modal após 2 segundos
            setTimeout(() => {
                const modalElement = formFoto.closest('.modal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement);
                if (modalInstance) modalInstance.hide();
                document.getElementById("textMsgFoto").innerHTML = "";
            }, 2000);
        }
    });
}

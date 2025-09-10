<?php
require_once  "../../api/configPerfil/buscarDados.php";

$id = $resultado['id'];
$nomeCompleto = $resultado['nome'];
$user = $resultado['user'];
$senha = $resultado['senha'];
$cargo = $resultado['cargo'];
$cadastro = $resultado['cadastro'];
$email = $resultado['email'];
$telefone = $resultado['telefone'];
$nascimento = $resultado['nascimento'];
$empresa = $resultado['empresa'];
$imagem = $resultado['imagem'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque - Perfil</title>
    <link href="../bootstrap-5.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/datatables.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>


<body>
    <!-- header -->
    <nav class="navbar navbar-expand navbar-light navbar-custom">
        <a class="btn btn-link me-3" id="toggleSidebar">
            <i class="bi bi-list" style="color: black;"></i>
        </a>

        <a class="navbar-brand" href="../../index.html">Sistema de Estoque</a>

        <div class="ms-auto  d-flex align-items-center gap-3">
            <p class="text-dark text-center margin-auto">Bem vindo, <a style="text-decoration: none; color: black;" href="#"><b>Usuário</b></a></p>
        </div>
    </nav>

    <!-- sidebar -->
    <section class="sidebar" id="sidebar">
        <a href="../../index.html"><i class="bi bi-box-seam"></i><span> Produtos</span></a>
        <a href="usuarios.html"><i class="bi bi-people"></i><span> Usuários</span></a>
        <a href="configuracoes.html"><i class="bi bi-gear"></i><span> Configurações</span></a>
        <a href="help.html"><i class="bi bi-info-circle"></i><span> HelpDesk</span></a>
        <a href="./notificacoes.php" class="notification-link">
            <i class="bi bi-bell"></i> Notificações
            <span class="notification-badge hiddenBadge"></span>
        </a>
        <a href="./futuras.html"><i class="bi bi-capslock"></i> Futuras Implementações</a>
        <a href="exit.php"><i class="bi bi-box-arrow-left"></i><span> Sair</span></a>
    </section>

    <!-- conteúdo principal -->
    <main class="main-content" id="mainContent" style="margin-top: 10px;">
        <section >
            <h1>Perfil</h1>
        </section>

        <section id="perfil">
            <div class="infos"> 
                <div class="fotoPerfil imagem-container">
                    <img class="imagem-quadrada" src="<?php echo $imagem; ?>" alt="">

                </div>
                <div class="dadosPerfil">
                    <div class="dados">
                        <div class="dado">  
                            <h5 class="dadoTitle"><b>Nome Completo</b></h5>
                            <p class="dadoCont"><?php echo $nomeCompleto ?></p>
                        </div>
                        <div class="dado">
                            <h5 class="dadoTitle"><b>User</b></h5>
                            <p class="dadoCont"><?php echo $user ?></p>
                        </div>
                    </div>

                    <div class="dados">
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Cargo</b></h5>
                            <p class="dadoCont"><?php echo $cargo ?></p>
                        </div>
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Cadastro</b></h5>
                            <p class="dadoCont"><?php echo $cadastro ?></p>
                        </div>
                    </div>

                    <div class="dados">
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Email</b></h5>
                            <p class="dadoCont"><?php echo $email ?></p>
                        </div>
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Telefone</b></h5>
                            <p class="dadoCont"><?php echo $telefone ?></p>
                        </div>
                    </div>

                    <div class="dados">
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Empresa</b></h5>
                            <p class="dadoCont"><?php echo $empresa ?></p>
                        </div>
                    </div>

                    <div class="configs">
                        <div class="btns-change">
                            
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalAlterarSenha">
                                Alterar Senha
                            </button>
                            
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalAlterarFoto">
                                Alterar Foto de Perfil
                            </button>
                            
                            <button class="btn btn-outline-secondary" onclick="window.location.href='usuarios.html'" >Alterar Dados de Usuário</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- modais -->
            <!-- modal de alterar foto de perfil -->
            <div class="modal fade" id="ModalAlterarFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar Foto de Perfil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <label for="inputimg" class="form-label">Imagem Atual</label>
                            <div class="mb-2">
                                <img style="height: 200px; width:200px; object-fit: cover; object-position: center;" src="<?php echo $imagem; ?>" alt="">
                            </div>
                            <hr>
                            <label for="edit_imagem" class="form-label">Nova Foto de Perfil</label>
                            <input type="file" class="form-control" id="edit_imagem" name="imagem" accept="image/*">
                            <small class="text-muted">Selecione uma nova imagem para substituir a atual (opcional).</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- modal de alterar senha -->
            <div class="modal fade" id="ModalAlterarSenha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-userid="<?php echo htmlspecialchars($id); ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar Senha de Login</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           <div>
                               <label for="edit_senha" class="form-label">Nova Senha</label>
                               <div class="input-group">
                                   <input type="password" class="form-control" id="edit_senha" placeholder="Digite a nova senha" name="senha">
                                   <button class="btn btn-outline-secondary" type="button" id="toggleSenhaEdit2">
                                       <i class="bi bi-eye"></i>
                                   </button>
                               </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <footer>
        © 2025   <a style="text-decoration: none; color: black; font-weight: bold;" href="https://www.linkedin.com/in/matheuskauandums/" target="_blank">Matheus Kauan Dums</a> - Sistema de Estoque v.1.0.0
    </footer>

    </main>
    

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../js/datatables.min.js"></script>
    <script src="../js/script.js?v=<?= filemtime('../js/script.js') ?>"></script>
    <script src="../js/scriptPerfil.js?v=<?= filemtime('../js/scriptPerfil.js') ?>"></script>
</body>

</html>
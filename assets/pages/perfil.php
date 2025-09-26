<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit();
}   

$id = $_SESSION['user_id'] ?? null;
$nomeCompleto = $_SESSION['nome'] ?? 'Usuário';
$user = $_SESSION['username'] ?? 'user';
$senha = $_SESSION['senha'] ?? 'senha';
$cargo = $_SESSION['cargo'] ?? 'cargo';
$cadastro = $_SESSION['cadastro'] ?? '';
$email = $_SESSION['email'] ?? '';
$telefone = $_SESSION['telefone'] ?? '';
$empresa = $_SESSION['empresa'] ?? '';
$imagem = $_SESSION['imagem'] ?? 'assets/images/imagens/user.png';

?>

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

        <a class="navbar-brand" href="../../index.php">Sistema de Estoque</a>

        <div class="ms-auto  d-flex align-items-center gap-3">
            <p class="text-dark text-center margin-auto">Bem vindo, <a style="text-decoration: none; color: black;" href="#"><b><?php echo $_SESSION['nome']; ?></b></a></p>
        </div>
    </nav>

    <!-- sidebar -->
    <section class="sidebar" id="sidebar">
        <a href="../../index.php"><i class="bi bi-box-seam"></i><span> Produtos</span></a>
        <a href="usuarios.php"><i class="bi bi-people"></i><span> Usuários</span></a>
        <a href="configuracoes.php"><i class="bi bi-gear"></i><span> Configurações</span></a>
        <a href="help.php"><i class="bi bi-info-circle"></i><span> HelpDesk</span></a>
        <a href="./notificacoes.php" class="notification-link">            <i class="bi bi-bell"></i> <span>Notificações</span><span class="notification-badge hiddenBadge"></span></a>       
        <a href="assets/pages/futuras.php"><i class="bi bi-capslock"></i> <span>Futuras Implementações</span></a>
        <a href="exit.php"><i class="bi bi-box-arrow-left"></i><span> Sair</span></a>
    </section>

    <!-- conteúdo principal -->
    <main class="main-content" id="mainContent" style="margin-top: 30px;">
        <section>
            <h1>Perfil</h1>
        </section>

        <section id="perfil">
            <div class="msgAlerta"><span id="msgAlertBody"></span></div>
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

                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalParaAlterarSenha">
                                Alterar Senha
                            </button>

                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#ModalAlterarFoto">
                                Alterar Foto de Perfil
                            </button>

                            <button class="btn btn-outline-secondary" onclick="window.location.href='usuarios.php'">Alterar Dados de Usuário</button>
                        </div>

                    </div>



                </div>

            </div>

            <!-- modais -->
            <!-- modal de alterar foto de perfil -->
            <div class="modal fade" id="ModalAlterarFoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar Foto de Perfil</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formAlterarFoto" enctype="multipart/form-data">
                                <div class="msgAlertSenha mb-2 text-center"><span id="textMsgFoto"></span></div>
                                <input type="hidden" class="form-control" id="id_foto" name="id" value="<?php echo $id; ?>">
                                <label for="inputimg" class="form-label">Imagem Atual</label>
                                <div class="mb-2 d-flex justify-content-center">
                                    <img id="imgPreview" style="height: 200px; width:200px; object-fit: cover; object-position: center;" src="<?php echo $imagem; ?>" alt="">
                                </div>
                                <hr>
                                <label for="edit_imagem" class="form-label">Nova Foto de Perfil</label>
                                <input type="file" class="form-control" id="edit_imagem" name="imagem" accept="image/*">
                                <small class="text-muted">Selecione uma nova imagem para substituir a atual (opcional).</small>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-outline-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal de alterar senha -->
            <div class="modal fade" id="ModalParaAlterarSenha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Alterar Senha de Login</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" id="ModalAlterarSenha">
                                <div class="msgAlertSenha"><span id="textMsgSenha"></span></div>
                                <div class="col-md-6">
                                    <input type="hidden" class="form-control" id="id_senha" name="id" value="<?php echo $id; ?>">
                                    <label for="inputSenha" class="form-label">Senha Antiga (criptografada)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="edit_senha_user" placeholder="*********" name="senha_user" value="<?php echo $senha; ?>">
                                        <button class="btn btn-outline-secondary editUsers" type="button" id="toggleSenhaEdit">
                                            <span class="olhoIcone"><i class="bi bi-eye"></i></span>
                                        </button>
                                    </div>
                                    <hr>
                                    <label for="inputSenha" class="form-label">Nova Senha</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="edit_senha" placeholder="*********" name="senha">
                                        <button class="btn btn-outline-secondary editUsers" type="button" id="toggleSenhaEdit2">
                                            <span class="olhoIcone"><i class="bi bi-eye"></i></span>
                                        </button>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary">Salvar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>






        </section>

        <footer>
            © 2025 <a style="text-decoration: none; color: black; font-weight: bold;" href="https://www.linkedin.com/in/matheuskauandums/" target="_blank">Matheus Kauan Dums</a> - Sistema de Estoque v.1.0.0<!--  - All Rights Reserved. -->
        </footer>

    </main>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../js/datatables.min.js"></script>
    <script src="../js/script.js?v=<?= filemtime('../js/script.js') ?>"></script>
    <script src="../js/scriptPerfil.js?v=<?= filemtime('../js/scriptPerfil.js') ?>"></script>
</body>

</html>
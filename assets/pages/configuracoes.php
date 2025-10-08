<?php
require_once __DIR__ . '/../../api/config/check_auth.php';

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Estoque - Configurações</title>
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
            <p class="text-dark text-center margin-auto">Bem vindo, <a style="text-decoration: none; color: black;" href="./perfil.php"><b><?php echo $_SESSION['nome']; ?></b></a></p>
        </div>
    </nav>

    <!-- sidebar -->
    <section class="sidebar" id="sidebar">
<!--         <a href="../../index.php"><i class="bi bi-speedometer2"></i><span> Produtos</span></a> -->
        <a href="../../produtos.php"><i class="bi bi-box-seam"></i><span> Produtos</span></a>
        <a href="usuarios.php"><i class="bi bi-people"></i><span> Usuários</span></a>
        <a href="configuracoes.php"><i class="bi bi-gear"></i><span> Configurações</span></a>
        <a href="help.php"><i class="bi bi-info-circle"></i><span> HelpDesk</span></a>
        <a href="./notificacoes.php" class="notification-link">
            <i class="bi bi-bell"></i> <span>Notificações</span><span class="notification-badge hiddenBadge"></span></a>       
        <a href="assets/pages/futuras.php"><i class="bi bi-capslock"></i> <span>Futuras Implementações</span></a>
        <a href="exit.php"><i class="bi bi-box-arrow-left"></i><span> Sair</span></a>
    </section>

    <!-- conteúdo principal -->
    <main class="main-content" id="mainContent">
        <section class="first-text" >
            <h1><b>Configurações</b> do Sistema</h1>
        </section>

        <hr>
        <section class="conteudo-principal" style="display: flex; justify-content: center; align-items: center; text-align: center; ">
            <div style="border: 2px solid black; width: fit-content; padding: 10px;">
                <h3>EM BREVE </h3>
            </div>
        </section>

        <hr>
        <section id="infos">
            <h3>Dados da <b>Empresa</b></h3>

            <div class="infos">
                <div class="dados">
                    <div class="dado">
                        <p><b>Nome da Empresa: </b> Saint Tropez Technologies</p>
                        <p><b>Endereço: </b></p>
                        <p><b>Telefone: </b></p>
                        <p><b>Email: </b></p>
                    </div>

                    <div class="dado">
                        <p><b>Usuários do Sistema: </b></p>
                    </div>
                </div>
            </div>

            <hr>
            <h3>Dados do <b>Sistema</b></h3>
            <div class="dadosSistema">
                <div class="infos" style="width: 100%;">
                    <div class="dados">
                        <div class="dado">
                            <p><b>Nome: </b>Sistema de Estoque</p>
                            <p><b>Versão: </b> v1.0.0</p>
                            <p><b>Ano: </b>2025</p>
                            <p><b>Desenvolvido Por: </b><a href="https://linktr.ee/matheusdums" target="_blank" style=" color: black; text-decoration: none;">Matheus Dums</a></p>
                            <p><b>Empresa: </b>Saint Tropez Technologies</p>
                        </div>
                    </div>

                    <div class="dados">
                    <div class="dado">
                        <h5>💻<b>Redes Sociais:</b></h5>
                        <p><i>Linktree: </i><a href="https://linktr.ee/matheusdums" target="_blank" style=" color: black; text-decoration: none;"><b>Matheus Dums</b></a></p>
                        <br>
                        <h5>💻<b>Fale Conosco:</b></h5>
                        <a href="./futuras.php" style=" color: black;"><b>Página de Sugestões</b></a>
                    </div>
                </div>
                </div>
            </div>
            
        </section>

        <footer>
        © 2025   <a style="text-decoration: none; color: black; font-weight: bold;"  href="https://linktr.ee/matheusdums" target="_blank">Matheus Kauan Dums</a> - Sistema de Estoque v.1.0.0<!--  - All Rights Reserved. -->
        </footer>
    </main>



    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../js/datatables.min.js"></script>
    <script src="../js/script.js?v=<?= filemtime('../js/script.js') ?>"></script>
    <script src="../js/scriptConfig.js?v=<?= filemtime('../js/scriptConfig.js') ?>"></script>
</body>

</html>
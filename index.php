<?php
require_once __DIR__ . '/api/config/check_auth.php';
require_once __DIR__ . '/api/configMain/buscaDados.php';
include_once 'api/configAdmin/listarRecados.php';
$recados = listarRecados($conn);

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
    <title>Sistema de Estoque</title>
    <link href="assets/bootstrap-5.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand navbar-light navbar-custom">
        <a class="btn btn-link me-3" id="toggleSidebar">
            <i class="bi bi-list" style="color: black;"></i>
        </a>

        <a class="navbar-brand" href="#">Sistema de Estoque</a>

        <div class="ms-auto  d-flex align-items-center gap-3">
            <p class="text-dark text-center margin-auto">Bem vindo, <a style="text-decoration: none; color: black;"
                    href="assets/pages/perfil.php"><b><?php echo $_SESSION['nome']; ?></b></a></p>
        </div>
    </nav>

    <!-- sidebar -->
    <section class="sidebar" id="sidebar">
        <a href="produtos.php"><i class="bi bi-box-seam"></i><span> Produtos</span></a>
        <a href="assets/pages/usuarios.php"><i class="bi bi-people"></i><span> Usuários</span></a>
        <a href="assets/pages/configuracoes.php"><i class="bi bi-gear"></i><span> Configurações</span></a>
        <a href="assets/pages/help.php"><i class="bi bi-info-circle"></i><span> HelpDesk</span></a>
        <a href="assets/pages/notificacoes.php" class="notification-link">
            <i class="bi bi-bell"></i> <span>Notificações</span><span class="notification-badge hiddenBadge"></span></a>       
        <a href="assets/pages/futuras.php"><i class="bi bi-capslock"></i> <span>Futuras Implementações</span></a>
        <a href="assets/pages/exit.php"><i class="bi bi-box-arrow-left"></i><span> Sair</span></a>
    </section>

    <main class="main-content" id="mainContent">
        <section class="main_text">
            <h1>Bem-vindo, <b><?php echo $_SESSION['nome']; ?></b>!</h1>
            <p>Bem-vindo ao seu sistema de Estoque.</p>
        </section>

        <hr>

        <section class="parent">
            <div class="div1 card" style="width: 97%; margin-bottom: 2rem; display: flex; justify-content: center; align-items: center;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                    <h2 class="card-title">Valor Total do Estoque</h2>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Soma do valor de todos os produtos</h6>
                    <h1 class="card-text" style="font-size: 5rem; margin-top: 2rem;">
                        R$ <?php echo number_format($valorTotalEstoque, 2, ',', '.'); ?>
                    </h1>
                    <a href="produtos.php" style="color: black; text-decoration: none; bottom: 1rem;" class="card-link">
                        Ir para produtos ->
                    </a>
                </div>
            </div>


            <div class="div2 card" style="width: 97%; margin-bottom: 2rem;">
                <div class="card-body">
                    <h2 class="card-title">Recados do Desenvolvedor</h2>
                    <hr>
                    <?php 
                    $contador = 0; 
                    foreach ($recados as $recado): 
                        if ($contador >= 2) break; 
                        $contador++; ?>
                    <div class="recados-content">
                        <h5><span>⚠️ <?php echo $recado['titulo']; ?></span></h5>
                        <h6><span><?php echo $recado['mensagem']; ?></span></h6>
                        <p><span><?php echo $recado['admin'] . " - " . $recado['criado']; ?></span></p>
                        <hr>    
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="div3 card" style="width: 97%;  margin-bottom: 2rem; display: flex; justify-content: center; align-items: center;">
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                    <h2 class="card-title">Produtos Cadastrados</h2>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Total de Produtos Cadastrados</h6>
                    <h1 class="card-text" style="font-size: 7rem;"><span class="span-cadastrados"><?php echo $resultadoProdutos ?></span></h1>
                    <a href="index.php" style="color: black; text-decoration: none;" class="card-link">Ir para Produtos -></a>
                </div>
                
                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                    <h2 class="card-title">Usuários Cadastrados</h2>
                    <h6 class="card-subtitle mb-2 text-body-secondary">Total de Usuários Cadastrados</h6>
                    <h1 class="card-text" style="font-size: 7rem;"><span class="span-usuarios"><?php echo $resultadoUsuarios ?></span></h1>
                    <a href="assets/pages/usuarios.php" style="color: black; text-decoration: none;" class="card-link">Ir para Usuários -></a>
                </div>
            </div>

        </section>

        <footer>
        <a href="admin/loginAdmin.php" style="color: black; text-decoration: none;">Parte Exclusiva do Administrador</a> © 2025   <a style="text-decoration: none; color: black; font-weight: bold;" href="https://linktr.ee/matheusdums" target="_blank">Matheus Kauan Dums</a> - Sistema de Estoque v.1.0.0
        </footer>

    </main>


    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/main.js?v=<?= filemtime('assets/js/main.js') ?>"></script>
    <script src="assets/js/scriptMain.js?v=<?= filemtime('assets/js/scriptMain.js') ?>"></script>

</body>

</html>
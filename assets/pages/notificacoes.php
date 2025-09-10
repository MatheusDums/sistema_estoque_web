<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações - Sistema de Estoque</title>
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

        <a class="navbar-brand" href="#">Sistema de Estoque</a>

        <div class="ms-auto  d-flex align-items-center gap-3">
            <p class="text-dark text-center margin-auto">Bem vindo, <a style="text-decoration: none; color: black;"
                    href="./perfil.php"><b>Usuário</b></a></p>
        </div>
    </nav>

    <!-- sidebar -->
    <section class="sidebar" id="sidebar">
        <!--<a href="../../index.html"><i class="bi bi-speedometer2"></i><span> Produtos</span></a> -->
        <a href="../../index.html"><i class="bi bi-box-seam"></i><span> Produtos</span></a>
        <a href="./usuarios.html"><i class="bi bi-people"></i><span> Usuários</span></a>
        <a href="./configuracoes.html"><i class="bi bi-gear"></i><span> Configurações</span></a>
        <a href="./help.html"><i class="bi bi-info-circle"></i><span> HelpDesk</span></a>
        <a href="#" class="notification-link">
            <i class="bi bi-bell"></i>
            <span>Notificações</span>
            <span class="notification-badge hiddenBadge" id="notificationBadge"></span>
        </a>
        <a href="./futuras.html"><i class="bi bi-capslock"></i> Futuras Implementações</a>
        <a href="./exit.php"><i class="bi bi-box-arrow-left"></i><span> Sair</span></a>
    </section>
  
    <main class="main-content" id="mainContent">
        <section class="main_text">
            <h1><b>Notificações</b> do Sistema.</h1>
            <p>Notificações enviadas pelo sistema</p>
        </section>

        <section id="notifications-feed">

        </section>
        
        <footer>
        © 2025   <a style="text-decoration: none; color: black; font-weight: bold;" href="https://www.linkedin.com/in/matheuskauandums/" target="_blank">Matheus Kauan Dums</a> - Sistema de Estoque v.1.0.0<!--  - All Rights Reserved. -->
        </footer>

    </main>
    




    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../js/datatables.min.js"></script>
    <script src="../js/script.js?v=<?= filemtime('../js/script.js') ?>"></script>
    <script src="../js/scriptNot.js?v=<?= filemtime('../js/scriptNot.js') ?>"></script>
</body>
</html>
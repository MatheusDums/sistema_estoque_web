<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Sugestões</title>
    <link href="../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand navbar-light navbar-custom">
        <a class="btn btn-link me-3" id="toggleSidebar">
            <i class="bi bi-list" style="color: black;"></i>
        </a>
        <a class="navbar-brand" href="./admin.php">Sistema de Estoque</a>
        <div class="ms-auto  d-flex align-items-center gap-3">
            <p class="text-dark text-center margin-auto"> Bem vindo, <a href="./perfil.php" style="text-decoration: none; color: black;">
                <b id="usuarioPopover"  data-bs-container="body" data-bs-toggle="popover" data-bs-placement="bottom"
                 data-bs-content="Aqui você acessa seu perfil e configurações">Admin</b></a>
            </p>
        </div>
    </nav>

    <!-- sidebar -->
    <section class="sidebar" id="sidebar">
        <!-- <a href="../../produtos.php"><i class="bi bi-box-seam"></i><span> Produtos</span></a> -->
        <a href="./usuarios.php"><i class="bi bi-people"></i><span> Usuários</span></a>
        <!-- <a href="configuracoes.php"><i class="bi bi-gear"></i><span> Configurações</span></a> -->
        <a href="./help.php"><i class="bi bi-info-circle"></i><span> HelpDesk</span></a>
        <a href="./recados.php" class="notification-link">            <i class="bi bi-bell"></i> <span>Recados</span><span class="notification-badge hiddenBadge"></span></a>       
        <a href="./sugestoes.php"><i class="bi bi-capslock"></i> <span>Sugestões/Melhorias</span></a>
        <a href="../index.php"><i class="bi bi-box-arrow-left"></i><span> Voltar ao Sistema de Estoque</span></a>
    </section>

    <!-- conteúdo principal -->
    <main class="main-content" id="mainContent">
        <section class="main_text">
            <h1><b>Sugestões</b> dos Usuários.</h1>
            <p>Listagem de Sugestões dos Usuários.</p>
        </section>

        <section class="tabela_section">
            <table id="tabela_sugestoes" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Empresa</th>
                        <th>Area</th>
                        <th>Mensagem</th>
                    </tr>
                </thead>
            </table>

        </section>

        
        



    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/script.js?v=<?= filemtime('../assets/js/script.js') ?>"></script>
    <script src="../assets/js/scriptSugestoes.js?v=<?= filemtime('../assets/js/scriptSugestoes.js') ?>"></script>
</body>

</html>
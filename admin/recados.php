<?php
include_once '../api/configAdmin/listarRecados.php';
$recados = listarRecados($conn);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Recados</title>
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
        <a class="navbar-brand" href="./admin.php">Sistema de Estoque</a>        <div class="ms-auto  d-flex align-items-center gap-3">
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
            <h1><b>Recados</b> do Desenvolvedor.</h1>
            <p>Recados que aparecem na tela inicial.</p>
        </section>

        <div class="AlertRecados">
        </div>

        <form method="POST" id="form-recados" style="margin-top: 20px; margin-bottom: 20px;">
            <div class="mb-3">
                <label for="titulo" class="form-label"><b>Titulo do Recado</b></label>
                <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Título do recado" style="margin-bottom: 10px;">
            </div>
            <div class="mb-3">
                <label for="recado" class="form-label"><b>Corpo do Recado</b></label>
                <textarea class="form-control" name="recado" id="recado" rows="3" placeholder="Digite o recado aqui..."></textarea>
            </div>
            <div class="mb-3">
                <label for="admin" class="form-label"><b>Autor do Recado</b></label>
                <input type="text" name="admin" class="form-control" id="admin" placeholder="Autor do recado" style="margin-bottom: 10px;">
            </div>
            <div style="display: flex; justify-content: center">
                <button type="submit" class="btn btn-secondary" style="height: 40px; font-size: 1rem; margin-top: 10px;">Enviar Recado</button>
            </div>
        </form>

        <hr>

        <section class="main_text">
            <h1><b>Últimos</b> Recados</h1>
        </section>
        
        <section id="lista-recados">
        <hr>    
        <?php foreach ($recados as $recado): ?>
            <div class="recados-content">
                <h2><span>⚠️ <?php echo $recado['titulo']; ?></span></h2>
                <h3><span><?php echo $recado['mensagem']; ?></span></h3>
                <p><span><?php echo $recado['admin'] . " - " . $recado['criado']; ?></span></p>
                <button class="btn btn-danger btn-sm btn-excluir-recado" data-id="<?php echo $recado['id']; ?>">Excluir Recado</button>

                <hr>
            </div>
        <?php endforeach; ?>
        </section>

        



    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/script.js?v=<?= filemtime('../assets/js/script.js') ?>"></script>
    <script src="../assets/js/scriptSugestoes.js?v=<?= filemtime('../assets/js/scriptSugestoes.js') ?>"></script>
</body>

</html>
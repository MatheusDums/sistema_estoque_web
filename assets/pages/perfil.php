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
<!--         <a href="../../index.html"><i class="bi bi-speedometer2"></i><span> Produtos</span></a> -->
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
    <main class="main-content" id="mainContent">
        <section>
            <h1>Perfil</h1>
        </section>

        <section id="perfil">
            <div class="infos"> 
                <div class="fotoPerfil imagem-container">
                    <img class="imagem-quadrada" src="../arquivos/uploadsUsers/68a29808cf9b6-F6C46D34-23C4-4468-B07C-A2FCC26C400D (1).JPEG" alt="">

                    <div class="social">
                        <p><img class="logosSocial" style="height: 40px;" src="../images/icons/linkedin.svg" alt=""><span  class="social-users linkedin-user">MatheusKauanDums</span></p>
                        <p><img class="logosSocial" style="height: 40px;" src="../images/icons/instagram.svg" alt=""><span class="social-users instagram-user">@_mdums</span></p>
                        <p><img class="logosSocial" style="height: 40px;" src="../images/icons/whatsapp.svg" alt=""><span  class="social-users whatsapp-user">47 988200851</span></p>
                    </div>
                </div>
                <div class="dadosPerfil">
                    <div class="dados">
                        <div class="dado">  
                            <h5 class="dadoTitle"><b>Nome Completo</b></h5>
                            <p class="dadoCont">Matheus Kauan Dums</p>
                        </div>
                        <div class="dado">
                            <h5 class="dadoTitle"><b>User</b></h5>
                            <p class="dadoCont">dums</p>
                        </div>
                    </div>

                    <div class="dados">
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Cargo</b></h5>
                            <p class="dadoCont">Desenvolvedor</p>
                        </div>
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Cadastro</b></h5>
                            <p class="dadoCont">3704</p>
                        </div>
                    </div>

                    <div class="dados">
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Email</b></h5>
                            <p class="dadoCont">dumss@icloud.com</p>
                        </div>
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Telefone</b></h5>
                            <p class="dadoCont">4798200851</p>
                        </div>
                    </div>

                    <div class="dados">
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Data de Nascimento</b></h5>
                            <p class="dadoCont">03/07/2004 (21 anos)</p>
                        </div>
                        <div class="dado">
                            <h5 class="dadoTitle"><b>Empresa</b></h5>
                            <p class="dadoCont">St. Troppez Technologies</p>
                        </div>
                    </div>

                    <div class="configs">
                        <div class="btns-change">
                            
                            <button class="btn btn-outline-secondary">Alterar senha</button>
                            
                            <button class="btn btn-outline-secondary">Alterar Foto de Perfil</button>
                            
                            <button class="btn btn-outline-secondary">Alterar Dados de Usuário</button>
                        </div>
                        
                    </div>
                    


                </div>

            </div>

        </section>


    </main>

    <script src="../js/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../js/datatables.min.js"></script>
    <script src="../js/script.js?v=<?= filemtime('../js/script.js') ?>"></script>
    <script src="../js/scriptPerfil.js?v=<?= filemtime('../js/scriptPerfil.js') ?>"></script>
</body>

</html>
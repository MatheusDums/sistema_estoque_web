<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administração</title>
    <link href="../assets/bootstrap-5.2.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/datatables.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="body_login">
    <main >
        <section id="loginForm">

            <div class="login_card">
                <div class="card_body">

                    <img src="../assets/images/imagens/icon.png" alt="" style="height: 170px;">

                    <h3 class="card-title text-center mb-4">Administração - Login</h3>

                    <div class="AlertLogin">
                        <?php
                        /* session_start();
                        if(isset($_SESSION['msg_login'])){
                            echo $_SESSION['msg_login'];
                            unset($_SESSION['msg_login']);
                        } */
                        ?>
                    </div>

                    <form method="POST" action="../api/configAdmin/authenticateAdm.php">

                        <div class="mb-3">
                            <label for="username" class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary editUsers" type="button" id="toggleSenha">
                                    <span class="olhoIcone"><i class="bi bi-eye"></i></span>
                                </button>
                            </div>
                            
                        </div>
                        <button type="submit" class="btn btn-secondary w-100" style="height: 50px; font-size: 1.3rem; margin-top: 10px;">Entrar</button>
                    </form>

                    <div class="forgetPass" style="margin-top: 15px;">
                        <a href="../index.php" style="color: black; text-decoration: none;">Voltar ao Sistema de Estoque</a>
                    </div>
                    
                </div>
            </div>

        </section>


    </main>

    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/loginScript.js?v=<?= filemtime('../assets/js/loginScript.js') ?>"></script>

</body>

</html>
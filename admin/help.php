<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - HelpDesks</title>
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
            <h1><b>HelpDesks</b> do Sistema.</h1>
            <p>Lista de HelpDesks.</p>
        </section>

        <span id="msgAlertHelp">
        </span>

        <section class="help_list">

            <div class="tabela">
                <table id="tabela" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th>Chamado</th>
                        <th>Usuário</th>
                        <th>Assunto</th>
                        <th>Nível</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            </table>
            </div>
        </section>
        
        <!-- modal de detalhes -->
            <div class="modal fade" id="visUserModalHelp" tabindex="-1" aria-labelledby="visUserModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content shadow-lg border-0">

                        <!-- Cabeçalho -->
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="visUserModalLabel">
                                <i class="bi bi-box-seam me-2"></i> Detalhes do Chamado
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>

                        <!-- Corpo -->
                        <div class="modal-body">
                            <dl class="row g-3">
                                <div class="col-12 text-center">
                                    <img id="imgHelp" src="" class="img-fluid rounded" alt="Imagem do Chamado" style="height: 200px;">
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" id="list_id" name="id">
                                    <dt class="fw-bold ">Número do Chamado</dt>
                                    <dd class="text-dark"><span id="id_help" data-id="" name="id_help">#</span></dd>
                                </div>
                                <div class="col-md-6">
                                    <dt class="fw-bold ">Usuário</dt>
                                    <dd class="text-dark"><span id="nome_modal" name="nome_modal"></span></dd>
                                </div>
                                <div class="col-md-6">
                                    <dt class="fw-bold ">Assunto</dt>
                                    <dd class="text-dark"><span id="assunto_modal" name="assunto_modal"></span></dd>
                                </div>
                                <div class="col-md-6">
                                    <dt class="fw-bold ">Área</dt>
                                    <dd class="text-dark"><span id="area_modal" name="area_modal"></span></dd>
                                </div>
                                <div class="col-md-6">
                                    <dt class="fw-bold ">Nível</dt>
                                    <dd class="text-dark"><span id="nivel_modal" name="nivel_modal"></span></dd>
                                </div>
                                <div class="col-md-6">
                                    <!-- <dt class="fw-bold ">Status</dt>
                                    <dd class="text-dark"><span id="status_modal" name="status_modal"></span></dd> -->
                                    <label for="status_modal" class="form-label">Status</label>
                                    <select class="form-select" id="status-modal" name="status-modal">
                                        <option value="Aguardando Aprovação" selected><span class="status_modal" id="status_modal" name="status_modal"></span></option>
                                        <option value="Em Atendimento">Em Atendimento</option>
                                        <option value="Pausado">Pausado</option>
                                        <option value="Finalizado">Finalizado</option>
                                        <option value="Cancelado">Cancelado</option>
                                        <option value="Recusado">Recusado</option>
                                    </select>
                                </div>
                                <div class="col-8">
                                    <dt class="fw-bold ">Descrição</dt>
                                    <dd class="text-dark"><span id="descricao_modal" name="descricao_modal"></span></dd>
                                </div>
                                <div class="col-4">
                                    <dt class="fw-bold ">Contato</dt>
                                    <dd class="text-dark"><span id="contato_modal" name="contato_modal"></span></dd>
                                </div>

                                <hr>

                                <div class="col-12 d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- modal alterar status -->

        



    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script src="../assets/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/datatables.min.js"></script>
    <script src="../assets/js/script.js?v=<?= filemtime('../assets/js/script.js') ?>"></script>
    <script src="../assets/js/scriptSugestoes.js?v=<?= filemtime('../assets/js/scriptSugestoes.js') ?>"></script>
</body>

</html>
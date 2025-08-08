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
                    href="assets/pages/perfil.html"><b>Usuário</b></a></p>
        </div>
    </nav>

    <!-- sidebar -->
    <section class="sidebar" id="sidebar">
        <!--<a href="../../index.html"><i class="bi bi-speedometer2"></i><span> Produtos</span></a> -->
        <a href="#"><i class="bi bi-box-seam"></i><span> Produtos</span></a>
        <a href="assets/pages/usuarios.html"><i class="bi bi-people"></i><span> Usuários</span></a>
        <a href="assets/pages/configuracoes.html"><i class="bi bi-gear"></i><span> Configurações</span></a>
        <a href="assets/pages/help.html"><i class="bi bi-info-circle"></i><span> Help</span></a>
        <a href="assets/pages/exit.php"><i class="bi bi-box-arrow-left"></i><span> Sair</span></a>
    </section>

    <main class="main-content" id="mainContent">
        <section class="main_text">
            <h1>Bem-vindo, <b>User</b>!</h1>
            <p>Aqui vai ficar a listagem de produtos.</p>
        </section>

        <section class="botoes">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Cadastrar Produto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Cadastro de Produto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputname" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="inputname"
                                        placeholder="Nome do produto">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputcode" class="form-label">Código</label>
                                    <input type="text" class="form-control" id="inputcode"
                                        placeholder="Código do produto">

                                </div>
                                <div class="col-12">
                                    <label for="inputdesc" class="form-label">Descrição</label>
                                    <input type="text" class="form-control" id="inputdesc"
                                        placeholder="Descrição do produto">
                                </div>
                                <div class="col-md-8">
                                    <label for="inputimg" class="form-label">Imagem</label>
                                    <input type="text" class="form-control" id="inputimg"
                                        placeholder="Ainda tem que implementar">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputdisponivel" class="form-label">Disponível</label>
                                    <select id="inputdisponivel" class="form-select">
                                        <option selected>Sim</option>
                                        <option>Não</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputprice" class="form-label">Valor Unitário (R$)</label>
                                    <input type="text" class="form-control" id="inputprice"
                                        placeholder="R$00,00">
                                </div>
                                <div class="col-md-4">
                                    <label for="inputcategoria" class="form-label">Categoria</label>
                                    <select id="inputcategoria" class="form-select">
                                        <option selected>Categoria</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="inputquant" class="form-label">Quant.</label>
                                    <input type="number" class="form-control" id="inputquant"
                                        placeholder="0">
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Fora de estoque
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12  text-center">
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <!-- <section class="main_text">
            <h1>Produtos Cadastrados</h1>
            <p>Aqui vai ficar a listagem de produtos.</p>
        </section> -->
        <!-- tabela -->
        <section class="tabela">
            <table id="tabela" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nome</th>
                        <th>Disponível</th>
                        <th>Quantidade</th>
                        <th>Valor (R$)</th>
                        <th>Categoria</th>
                        <th>Descrição</th>
                        <!-- th colspan="2">Ações</th> -->
                    </tr>
                </thead>
            </table>

        </section>

    </main>


    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
    <script src="assets/js/datatables.min.js">
    </script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>
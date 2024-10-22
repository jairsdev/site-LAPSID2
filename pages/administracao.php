<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração | LAPSID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>
    <?php include "../php/includes/navbar.php"; ?>

    <div class="wrapper">
        <main class="content container">
            <h1 class="mb-3 mt-2">Usuários</h1>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#adicionarUsuario">Adicionar usuário</button>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="usuario-table">
                    
                </tbody>
            </table>
            <!-- Modal para editar email e nome -->
             <div class="modal fade" id="editarUsuario">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Editar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nome" class="col-form-label">Nome</label>
                                    <input type="text" class="form-control" id="nome">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="col-form-label">Email</label>
                                    <input type="text" class="form-control" id="email">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary " data-bs-dismiss="modal" id='salvar_atualizar'>Salvar</button>
                        </div>
                    </div>
                </div>
             </div>
             <!-- Modal para inserir um usuário -->
              <div class="modal fade" id="adicionarUsuario">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Adicionar membro</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="mb-3">
                                    <label for="addNome" class="col-form-label">Nome</label>
                                    <input type="text" class="form-control" id="addNome">
                                </div>
                                <div class="mb-3">
                                    <label for="addEmail" class="col-form-label">Email</label>
                                    <input type="text" class="form-control" id="addEmail">
                                </div>
                                <div class="mb-3">
                                    <label for="addSenha" class="col-form-label">Senha</label>
                                    <input type="password" class="form-control" id="addSenha">
                                </div>
                                <div class="mb-3">
                                    <label for="addSenhaNovamente" class="col-form-label">Confirme a senha</label>
                                    <input type="text" class="form-control" id="addSenhaNovamente">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id='salvar_criar' data-bs-dismiss="modal">Salvar</button>
                        </div>
                    </div>
                </div>
              </div>

              <div class="modal fade" id="atualizarSenha">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Atualizar senha</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nome" class="col-form-label">Senha</label>
                                    <input type="text" class="form-control" id="senha">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="col-form-label">Confirme a senha</label>
                                    <input type="text" class="form-control" id="senhaNovamente">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary " data-bs-dismiss="modal" id='salvar_senha'>Salvar</button>
                        </div>
                    </div>
                </div>
             </div>
        </main>
    </div>

    <?php include "../php/includes/footer.php"; ?>

    <script src="../assets/js/modalErro.js"></script> <!-- Carrega a modal -->
    <script type="module" src="../assets/js/administracao.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
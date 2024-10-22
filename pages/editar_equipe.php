<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar equipe | LAPSID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>
    <?php include "../php/includes/navbar.php"; ?>

    <div class="wrapper">
        <main class="content container">
            <h1 class="mb-3 mt-2">Membros da equipe</h1>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#adicionarUsuario">Adicionar membro</button>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="integrante-table">
                    
                </tbody>
            </table>
            <!-- Modal para editar um membro da equipe -->
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
                                <div class="mb-3">
                                    <label for="titulo" class="col-form-label">Titulo</label>
                                    <input type="text" class="form-control" id="titulo">
                                </div>
                                <div class="mb-3">
                                    <label for="lattes" class="col-form-label">Lattes</label>
                                    <input type="text" class="form-control" id="lattes">
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
                                    <label for="addTitulo" class="col-form-label">Titulo</label>
                                    <input type="text" class="form-control" id="addTitulo">
                                </div>
                                <div class="mb-3">
                                    <label for="addLattes" class="col-form-label">Lattes</label>
                                    <input type="text" class="form-control" id="addLattes">
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
        </main>
    </div>

    <?php include "../php/includes/footer.php"; ?>

    <script type="module" src="../assets/js/gerenciarEquipe.js"></script>
    <script src="../assets/js/modalErro.js"></script> <!-- Carrega a modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
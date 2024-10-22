<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar publicações | LAPSID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/general.css">
</head>
<body>
<?php include "../php/includes/navbar.php"; ?>

<div class="wrapper">
    <main class="content container-fluid">
        <h2 class="mb-3 mt-2">Lista de publicações</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#adicionarPublicacao">Nova Publicação</button>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Conteúdo</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody id="publicacao-table">
                
            </tbody>
        </table>
         <!-- Modal para editar um projeto -->
         <div class="modal fade" id="editarPublicacao">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Editar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="mb-3">
                                    <label for="titulo" class="col-form-label">Título</label>
                                    <input type="text" class="form-control" id="titulo">
                                </div>
                                <div class="mb-3">
                                    <label for="link" class="col-form-label">Link</label>
                                    <input type="text" class="form-control" id="link">
                                </div>
                                <div class="mb-3" id="editorEditar"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="salvar_atualizar">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal para inserir uma publicação -->
            <div class="modal fade" id="adicionarPublicacao">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Adicionar Projeto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="mb-3">
                                    <label for="addTitulo" class="col-form-label">Título</label>
                                    <input type="text" class="form-control" id="addTitulo">
                                </div>
                                <div class="mb-3">
                                    <label for="addLink" class="col-form-label">Link</label>
                                    <input type="text" class="form-control" id="addLink">
                                </div>
                                <div class="mb-3" id="editorAdicionar"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="salvar_criar">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
    </main>
</div>

<?php include "../php/includes/footer.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="module" src="../assets/js/gerenciarPublicacoes.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script type="module" src="../assets/js/quillEditor.js"></script>
<script src="../assets/js/modalErro.js"></script>

</body>
</html>

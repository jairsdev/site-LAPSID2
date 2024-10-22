<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Parcerias | LAPSID</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>
    <?php include "../php/includes/navbar.php"; ?>

    <div class="wrapper">
        <main class="content container">
            <h2 class="mb-3 mt-2">Lista de parcerias</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#adicionarParceria">Adicionar parceria</button>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="parceria-table">
                    
                </tbody>
            </table>

            <div class="modal fade" id="editarParceria">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalLabel">Editar</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="mb-3">
                                    <label for="logo" class="col-form-label">Logo</label>
                                    <!-- MAX_FILE_SIZE deve preceder o campo input (em bytes) -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                                    <!-- O Nome do elemento input determina o nome da array $_FILES -->
                                    <input name="image" type="file" id="logo"/><br>
                                </div>
                                <div class="mb-3" id="editorEditar"></div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary " data-bs-dismiss="modal" id='salvar_atualizar'>Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="adicionarParceria">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Adicionar Parceria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form action="">
                                <div class="mb-3">
                                    <label for="addLogo" class="col-form-label">Logo</label>
                                    <!-- MAX_FILE_SIZE deve preceder o campo input (em bytes) -->
                                    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                                    <!-- O Nome do elemento input determina o nome da array $_FILES -->
                                    <input name="addLogo" type="file" id="addLogo"/><br>
                                </div>
                                <div class="mb-3" id="editorAdicionar"></div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script type="module" src="../assets/js/quillEditor.js"></script>
    <script type="module" src="../assets/js/gerenciarParcerias.js"> </script>
    <script src="../assets/js/modalErro.js"></script> <!-- Carrega a modal -->
</body>

</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LAPSID</title>

    <!-- Bootstrap CDN links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/general.css">
</head>
<body>

    <?php include "../php/includes/navbar.php"; ?>

    <main class="container">
        <div class="card mx-auto  mt-5" style="width: 35rem">
            <h5 class="card-header text-center">Login</h5>
            <div class="card-body">
                <form id="login-form" action="">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="example@ifba.edu.br">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" id="senha" class="form-control">
                    </div>

                    <div class="mb-3">
                        <button class="btn btn-primary" id="entrar" type="submit">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script type="module" src="../assets/js/gerenciarUsuario.js"></script>
    <script src="../assets/js/modalErro.js"></script> <!-- Carrega a modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
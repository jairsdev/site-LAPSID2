<nav class="navbar navbar-expand-lg"> 
  <div class="container-fluid">
    <a class="navbar-brand" href="/site-LAPSID/index.php"><img src="/site-LAPSID/assets/img/logo.png" alt="" style="width:5em"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
  <div class="navbar-nav me-auto mb-2 mb-lg-0">
    <a class="nav-link" href="/site-LAPSID/pages/equipe.php">Equipe</a>
    <a class="nav-link" href="/site-LAPSID/pages/projetos.php">Projetos</a>
    <a class="nav-link" href="/site-LAPSID/pages/publicacoes.php">Publicações</a>
    <a class="nav-link" href="/site-LAPSID/pages/noticias.php">Notícias</a>
    <a class="nav-link" href="/site-LAPSID/pages/parcerias.php">Parcerias</a>
    <a class="nav-link" href="/site-LAPSID/pages/contato.php">Contatos</a>
    <?php session_start();
    if (isset($_SESSION['usuario_id'])) { ?>
      <div class="nav-item dropdown">
        <button class="nav-link btn dropdown-toggle" id="dropdownMenuButton1" type="button" data-bs-toggle="dropdown" aria-expanded="false">Editar</button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><a href="/site-LAPSID/pages/editar_equipe.php" class="dropdown-item">Equipe</a></li>
          <li><a href="/site-LAPSID/pages/editar_projetos.php" class="dropdown-item">Projetos</a></li>
          <li><a href="/site-LAPSID/pages/editar_publicacoes.php" class="dropdown-item">Publicações</a></li>
          <li><a href="/site-LAPSID/pages/editar_noticias.php" class="dropdown-item">Notícias</a></li>
          <li><a href="/site-LAPSID/pages/editar_parcerias.php" class="dropdown-item">Parcerias</a></li>
          <li><a href="/site-LAPSID/pages/administracao.php" class="dropdown-item">Administração</a></li>
        </ul>
      </div>
      </div>
      </div>
    </div>
    <div class='nav-item dropdown' style="margin-right: 120px;">
    <button class='btn dropdown-toggle' id='dropdownMenuButton2' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
        <?php echo $_SESSION['nome_usuario']; ?>
    </button>
    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton2'>
        <li><button class='dropdown-item'  onclick='logout()'>Sair</button></li>
    </ul>
</div>
    <script src='/site-LAPSID/assets/js/logout.js'> </script>
  <?php
        } else {
  ?>
    </div>
    <a href="/site-LAPSID/pages/login.php" class="btn btn-outline-dark" role="button">Entrar</a>
  <?php } ?>
  </div>
</nav>
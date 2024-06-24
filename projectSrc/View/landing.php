<?php
require_once '../Controller/auth_check.php';
require_once '../DAO/database/db_connect.php';
require_once '../DAO/database/buscar_filmes.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  <link rel="stylesheet" href="css/landingStyle.css">
  <link rel="stylesheet" href="css/navbar.css">
  <title>Landing Page Safadosflix</title>
</head>
<body id="background">
  <header>
    <div class="site-name">Movie Finder</div>
    <nav>
      <a href="landing.html" class="categoria">Landing Page</a>
      <a href="management.html" class="cadastro">Gestão</a>
      <a href="#" class="suporte">Meu Perfil</a>
      <a href="#" class="suporte"><?php echo $user['NOME']; ?></a>
      <a href="../Controller/logout.php">Sair</a>
      <div class="search-box">
        <input type="text" placeholder="Digite aqui">
        <a href="#"><i class="fas fa-search"></i></a>
      </div>
    </nav>
  </header>

  <div class="containerThings" data-aos="fade-right">
    <h1 class="p2" data-aos="fade-up">Boa noite, Marcelo!</h1>
    <h1 id="p">Filmes em Alta</h1>
    <div class="movieBlock">
      <div class="movies-scroller">
        <?php foreach ($filmes as $filme) : ?>
          <div class="moviebox">
            <?php if (isset($filme['CAMINHO_POSTER'])) : ?>
              <img height="350" width="350" src="<?php echo $filme['CAMINHO_POSTER']; ?>" />
            <?php endif; ?>
            <h1 class="movieMiniName">
              <?php if (isset($filme['TITLE'])) : ?>
                <?php echo $filme['TITLE']; ?>
              <?php else : ?>
                <?php echo 'Título não disponível'; ?>
              <?php endif; ?>
            </h1>
            <p class="movieGenre">
              <?php if (isset($filme['GENEROS'])) : ?>
                <?php echo $filme['GENEROS']; ?>
              <?php else : ?>
                <?php echo 'Gênero não disponível'; ?>
              <?php endif; ?>
            </p>
            <a href="detalhamento.php?id=<?php echo htmlspecialchars($filme['ID'], ENT_QUOTES, 'UTF-8'); ?>">Clique para saber mais</a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>AOS.init();</script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require_once '../Controller/auth_check.php';
require_once '../DAO/database/db_connect.php';
require_once '../DAO/DadosUsuario.php';
require_once '../DAO/database/buscar_filmes.php';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="js/script.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/landingStyle.css">
  <link rel="stylesheet" href="css/navbar.css">
  <title>Landing Page Safadosflix</title>
</head>

<body id="background">
<header>
    <div class="site-name">Movie Finder</div>
    <nav>
        <div class="left-section">
            <a href="landing.php" class="categoria home-page">Home Page</a>
            <a href="management.php" class="categoria management">Gestão</a>
        </div>
        <div class="right-section">
            <a href="perfil.php"><?php echo $user['NOME'];?></a>
            <a href="../Controller/logout.php">Sair</a>
            <form method="POST" class="search-box" action="resultadoBusca.php">
                <input type="text" name="busca" placeholder="Digite aqui">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
    </nav>
</header>



  <div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="slideOne">
          <img src="img/gots.jpg" class="d-block w-100" id="slideOneBG" alt="Slide 1">
          <div class="infos">
            <h1 class="movieName">Scarface</h1>
            <p class="movieText">Scarface foi indicado a três Globos de Ouro: melhor ator de drama (Al Pacino), melhor coadjuvante de drama (Steven Bauer) e melhor trilha sonora original (Giorgio Moroder). A produção ficou em 10º lugar na lista dos dez melhores filmes de gângster do American Film Institute.</p>
            <button class="animated-button" id="buttonSM" onclick="window.location.href='detalhamento.html'">
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                </path>
              </svg>
              <span class="text">SAIBA MAIS</span>
              <span class="circle"></span>
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                </path>
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="slideOne">
          <img src="img/hg.jpg" class="d-block w-100" id="slideOneBG" alt="Slide 2">
          <div class="infos">
            <h1 class="movieName">The Hunger Games</h1>
            <p class="movieText">A história é estabelecida em um período distópico pós-apocalíptico na nação de Panem, onde meninos e meninas de 12 a 18 anos devem participar dos Jogos Vorazes, um evento anual televisionado no qual os "tributos" precisam lutar até a morte até que sobre apenas um, que é coroado vencedor.</p>
            <button class="animated-button" id="buttonSM" onclick="window.location.href='detalhamento.html'">
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                </path>
              </svg>
              <span class="text">SAIBA MAIS</span>
              <span class="circle"></span>
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                </path>
              </svg>
            </button>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="slideOne">
          <img src="img/pp.jpg" class="d-block w-100" id="slideOneBG" alt="Slide 3">
          <div class="infos">
            <h1 class="movieName">Pulp Fiction</h1>
            <p class="movieText">Assassino que trabalha para a máfia se apaixona pela esposa de seu chefe quando é convidado a acompanhá-la, um boxeador descumpre sua promessa de perder uma luta e um casal tenta um assalto que rapidamente sai do controle.</p>
            <button class="animated-button" id="buttonSM" onclick="window.location.href='detalhamento.html'">
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                </path>
              </svg>
              <span class="text" href="#">SAIBA MAIS</span>
              <span class="circle"></span>
              <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
                <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z">
                </path>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Próximo</span>
    </a>
  </div>

  <div class="containerThings" data-aos="fade-right">
    <h1 class="p2" data-aos="fade-up">Boa noite, <?php echo $user['NOME']; ?></h1>
    <div class="movieBlock">
      <h1 id="p">Filmes de Ação</h1>
      <div class="movieBlock">
        <div class="movies-scroller">
          <?php

          $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Action'";
          $result = $conn->query($sql);
          $filmes = array();
          if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
              $filmes[] = $row;
            }
          }
          ?>

          <?php if (!empty($filmes)) : ?>
            <?php foreach ($filmes as $filme) : ?>
              <div class="moviebox">
                <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

                <?php endif; ?>
                <h1 class="movieMiniName">
                  <?php if (isset($filme['TITLE'])) : ?>
                    <?php echo htmlspecialchars($filme['TITLE']); ?>
                  <?php else : ?>
                    Título não disponível
                  <?php endif; ?>
                </h1>
                <p class="movieGenre">
                  <?php if (isset($filme['GENEROS'])) : ?>
                    <?php echo htmlspecialchars($filme['GENEROS']); ?>
                  <?php else : ?>
                    Gênero não disponível
                  <?php endif; ?>
                </p>
                <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p>Nenhum filme de ação disponível no momento.</p>
          <?php endif; ?>
        </div>
      </div>
      </div>
      <h1 id="p">Filmes de Comedia</h1>
      <div class="movieBlock">
        <div class="movies-scroller">
          <?php

          $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Comedy'";
          $result = $conn->query($sql);
          $filmes = array();

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $filmes[] = $row;
            }
          }
          ?>

          <?php if (!empty($filmes)) : ?>
            <?php foreach ($filmes as $filme) : ?>
              <div class="moviebox">
                <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

                <?php endif; ?>
                <h1 class="movieMiniName">
                  <?php if (isset($filme['TITLE'])) : ?>
                    <?php echo htmlspecialchars($filme['TITLE']); ?>
                  <?php else : ?>
                    Título não disponível
                  <?php endif; ?>
                </h1>
                <p class="movieGenre">
                  <?php if (isset($filme['GENEROS'])) : ?>
                    <?php echo htmlspecialchars($filme['GENEROS']); ?>
                  <?php else : ?>
                    Gênero não disponível
                  <?php endif; ?>
                </p>
                <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p>Nenhum filme de ação disponível no momento.</p>
          <?php endif; ?>
        </div>
      </div>

      <h1 id="p">Filmes de Terror</h1>
      <div class="movieBlock">
        <div class="movies-scroller">
          <?php
          $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Horror'";
          $result = $conn->query($sql);
          $filmes = array();

          if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
              $filmes[] = $row;
            }
          }
          ?>

          <?php if (!empty($filmes)) : ?>
            <?php foreach ($filmes as $filme) : ?>
              <div class="moviebox">
                <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

                <?php endif; ?>
                <h1 class="movieMiniName">
                  <?php if (isset($filme['TITLE'])) : ?>
                    <?php echo htmlspecialchars($filme['TITLE']); ?>
                  <?php else : ?>
                    Título não disponível
                  <?php endif; ?>
                </h1>
                <p class="movieGenre">
                  <?php if (isset($filme['GENEROS'])) : ?>
                    <?php echo htmlspecialchars($filme['GENEROS']); ?>
                  <?php else : ?>
                    Gênero não disponível
                  <?php endif; ?>
                </p>
                <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p>Nenhum filme de ação disponível no momento.</p>
          <?php endif; ?>
        </div>
      </div>

      <h1 id="p">Filmes de Drama</h1>
      <div class="movieBlock">
        <div class="movies-scroller">
          <?php
          $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Drama'";
          $result = $conn->query($sql);

          $filmes = array();
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $filmes[] = $row;
            }
          }
          ?>

          <?php if (!empty($filmes)) : ?>
            <?php foreach ($filmes as $filme) : ?>
              <div class="moviebox">
                <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

                <?php endif; ?>
                <h1 class="movieMiniName">
                  <?php if (isset($filme['TITLE'])) : ?>
                    <?php echo htmlspecialchars($filme['TITLE']); ?>
                  <?php else : ?>
                    Título não disponível
                  <?php endif; ?>
                </h1>
                <p class="movieGenre">
                  <?php if (isset($filme['GENEROS'])) : ?>
                    <?php echo htmlspecialchars($filme['GENEROS']); ?>
                  <?php else : ?>
                    Gênero não disponível
                  <?php endif; ?>
                </p>
                <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p>Nenhum filme de ação disponível no momento.</p>
          <?php endif; ?>
        </div>
      </div>

      <h1 id="p">Filmes de Velho Oeste</h1>
      <div class="movieBlock">
        <div class="movies-scroller">
          <?php
          $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Western'";
          $result = $conn->query($sql);
          $filmes = array();
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $filmes[] = $row;
            }
          }
          ?>

          <?php if (!empty($filmes)) : ?>
            <?php foreach ($filmes as $filme) : ?>
              <div class="moviebox">
                <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

                <?php endif; ?>
                <h1 class="movieMiniName">
                  <?php if (isset($filme['TITLE'])) : ?>
                    <?php echo htmlspecialchars($filme['TITLE']); ?>
                  <?php else : ?>
                    Título não disponível
                  <?php endif; ?>
                </h1>
                <p class="movieGenre">
                  <?php if (isset($filme['GENEROS'])) : ?>
                    <?php echo htmlspecialchars($filme['GENEROS']); ?>
                  <?php else : ?>
                    Gênero não disponível
                  <?php endif; ?>
                </p>
                <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
              </div>
            <?php endforeach; ?>
          <?php else : ?>
            <p>Nenhum filme de ação disponível no momento.</p>
          <?php endif; ?>
        </div>
      </div>

      <h1 id="p">Filmes de Romance</h1>
    <div class="movieBlock">
      <div class="movies-scroller">
        <?php
        $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Romance,Drama'";
        $result = $conn->query($sql);

        $filmes = array();
    
        if ($result->num_rows > 0) {
        
            while ($row = $result->fetch_assoc()) {
                $filmes[] = $row;
            }
        }
        ?>

        <?php if (!empty($filmes)) : ?>
          <?php foreach ($filmes as $filme) : ?>
            <div class="moviebox">
              <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

              <?php endif; ?>
              <h1 class="movieMiniName">
                <?php if (isset($filme['TITLE'])) : ?>
                  <?php echo htmlspecialchars($filme['TITLE']); ?>
                <?php else : ?>
                  Título não disponível
                <?php endif; ?>
              </h1>
              <p class="movieGenre">
                <?php if (isset($filme['GENEROS'])) : ?>
                  <?php echo htmlspecialchars($filme['GENEROS']); ?>
                <?php else : ?>
                  Gênero não disponível
                <?php endif; ?>
              </p>
              <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <p>Nenhum filme de ação disponível no momento.</p>
        <?php endif; ?>
      </div>
    </div>

    <h1 id="p">Filmes de Fantasia</h1>
    <div class="movieBlock">
      <div class="movies-scroller">
        <?php
        $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Fantasy,Action'";
        $result = $conn->query($sql);
        $filmes = array();
        if ($result->num_rows > 0) {
        
            while ($row = $result->fetch_assoc()) {
                $filmes[] = $row;
            }
        }
        ?>

        <?php if (!empty($filmes)) : ?>
          <?php foreach ($filmes as $filme) : ?>
            <div class="moviebox">
              <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

              <?php endif; ?>
              <h1 class="movieMiniName">
                <?php if (isset($filme['TITLE'])) : ?>
                  <?php echo htmlspecialchars($filme['TITLE']); ?>
                <?php else : ?>
                  Título não disponível
                <?php endif; ?>
              </h1>
              <p class="movieGenre">
                <?php if (isset($filme['GENEROS'])) : ?>
                  <?php echo htmlspecialchars($filme['GENEROS']); ?>
                <?php else : ?>
                  Gênero não disponível
                <?php endif; ?>
              </p>
              <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <p>Nenhum filme de ação disponível no momento.</p>
        <?php endif; ?>
      </div>
    </div>

    <h1 id="p">Filmes de Ficção cientifica</h1>
    <div class="movieBlock">
      <div class="movies-scroller">
        <?php
        $sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS WHERE GENEROS = 'Science Fiction'";
        $result = $conn->query($sql);

        $filmes = array();
        if ($result->num_rows > 0) {
        
            while ($row = $result->fetch_assoc()) {
                $filmes[] = $row;
            }
        }
        ?>

        <?php if (!empty($filmes)) : ?>
          <?php foreach ($filmes as $filme) : ?>
            <div class="moviebox">
              <?php if (isset($filme['CAMINHO_POSTER'])) : ?><img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />

              <?php endif; ?>
              <h1 class="movieMiniName">
                <?php if (isset($filme['TITLE'])) : ?>
                  <?php echo htmlspecialchars($filme['TITLE']); ?>
                <?php else : ?>
                  Título não disponível
                <?php endif; ?>
              </h1>
              <p class="movieGenre">
                <?php if (isset($filme['GENEROS'])) : ?>
                  <?php echo htmlspecialchars($filme['GENEROS']); ?>
                <?php else : ?>
                  Gênero não disponível
                <?php endif; ?>
              </p>
              <a id="know" href="detalhamento.php?id=<?php echo urlencode($filme['ID_FILME']); ?>">Clique para saber mais</a>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <p>Nenhum filme de ação disponível no momento.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
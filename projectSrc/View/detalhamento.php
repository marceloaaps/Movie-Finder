<?php
require_once '../Controller/auth_check.php';
require_once '../DAO/database/db_connect.php';
require_once '../DAO/database/detalhamento_filmes.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Filme</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/detalhamento.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>

<body>
    <header>
        <div class="site-name">Movie Finder</div>
        <nav>
            <a href="landing.html" class="categoria">Landing Page</a>
            <a href="management.html" class="cadastro">Gestão</a>
            <a href="#" class="suporte">Meu Perfil</a>
            <a href="login.html" class="perfil">Sair</a>
            <div class="search-box">
                <input type="text" placeholder="Digite aqui">
                <a href="#"><i class="fas fa-search"></i></a>
            </div>
        </nav>
    </header>
    <main>
        <div class="movie-details">
        <div class="movies-scroller">
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
              <?php if (isset($filme['SINOPSE'])) : ?>
                <?php echo $filme['SINOPSE']; ?>
              <?php else : ?>
                <?php echo 'Sinopse não disponível'; ?>
              <?php endif; ?>
            </p>
            <p class="movieGenre">
              <?php if (isset($filme['GENEROS'])) : ?>
                <?php echo $filme['GENEROS']; ?>
              <?php else : ?>
                <?php echo 'Gênero não disponível'; ?>
              <?php endif; ?>
            </p>
            <p class="movieGenre">
              <?php if (isset($filme['ANO_LANCAMENTO'])) : ?>
                <?php echo $filme['ANO_LANCAMENTO']; ?>
              <?php else : ?>
                <?php echo 'Ano não disponível'; ?>
              <?php endif; ?>
            </p>
          </div>
            <br>
            <button onclick="toggleDetails()">Mais Detalhes</button>
            <div id="additional-info" style="display: none;">
                <h2>Informações Adicionais</h2>
                <p>Assessoria de conteúdo: Linguagem inadequada, drogas, violência extrema</p>
                <p>Idiomas de áudio: Inglês, Português, Español (Latinoamérica), Español (Espanha), Euskara, Galego, Català</p>
                <p>Legendas: Inglês [CC], Português (Brasil), Português (Brasil) [SDH], Català, Español (Latinoamérica), Español (Latinoamérica) [CC], Español (España), Español (España) [CC], Euskara, Galego, Português (Portugal), Português (Portugal) [CC]</p>
                <p>Diretores: David Ayer</p>
                <p>Produtores: Bill Block, Chris Long, Jason Statham, Kurt Wimmer</p>
                <p>Estrelando: Jason Statham, Emmy Raver-Lampman, Josh Hutcherson</p>
                <p>Estúdio: Entretenimento Cedar Park</p>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-section">
            <h2>Filmes Relacionados</h2>
            <div class="carousel-container">
                <div class="carousel">
                    <div class="carousel-item">
                        <img src="img/filme1.jpg" alt="Filme 1">
                        <div class="carousel-item-overlay">"Filme Relacionado 1"</div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/foto5.png" alt="Filme 2">
                        <div class="carousel-item-overlay">"Filme Relacionado 2"</div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/filme.jpg" alt="Filme 3">
                        <div class="carousel-item-overlay">"Filme Relacionado 3"</div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/shrek5.jpg" alt="Filme 4">
                        <div class="carousel-item-overlay">"Filme Relacionado 4"</div>
                    </div>
                    <div class="carousel-item">
                        <img src="img/bomberman.jpg" alt="Filme 5">
                        <div class="carousel-item-overlay">"Filme Relacionado 5"</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        function toggleDetails() {
            var additionalInfo = document.getElementById('additional-info');
            var moreButton = document.querySelector('.movie-details button');

            if (additionalInfo.style.display === 'none') {
                additionalInfo.style.display = 'block';
                moreButton.textContent = 'Ocultar Detalhes';
            } else {
                additionalInfo.style.display = 'none';
                moreButton.textContent = 'Mais Detalhes';
            }
        }
    </script>
</body>

</html>
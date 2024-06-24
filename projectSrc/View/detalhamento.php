<?php
require_once '../DAO/database/db_connect.php';
require_once '../DAO/database/buscar_filmes.php';
require_once '../DAO/database/lading.php';

$id = $_GET['id'];

class FilmeController {
    public function detalhes($id) {
        global $conn;
        $sql = "SELECT * FROM filmes WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            echo "Filme não encontrado!";
            exit;
        }

        $stmt->close();
    }
}

$filmeController = new FilmeController();
$filme = $filmeController->detalhes($id);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Filme</title>
    <link rel="stylesheet" href="/public/css/detalhamento.css">
    <link rel="stylesheet" href="/public/css/navbar.css">
</head>
<body>
    <header>
        <div class="site-name">Movie Finder</div>
        <nav>
            <a href="/" class="categoria">Landing Page</a>
            <a href="/management" class="cadastro">Gestão</a>
            <a href="/profile" class="suporte">Meu Perfil</a>
            <a href="/logout" class="perfil">Sair</a>
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
                        <?php echo $filme['TITLE'] ?? 'Título não disponível'; ?>
                    </h1>
                    <p class="movieGenre">
                        <?php echo $filme['DESCRICAO'] ?? 'Sinopse não disponível'; ?>
                    </p>
                </div>
                <a href="/" style="display: inline-block; padding: 10px 20px; background-color: white; color: #333; text-decoration: none; border: 1px solid #333; border-radius: 5px;">Voltar</a>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer-section">
            <h2>Filmes Relacionados</h2>
            <div class="carousel-container">
                <div class="carousel">
                    <div class="carousel-item">
                        <?php if (isset($filme['CAMINHO_POSTER'])) : ?>
                            <img height="350" width="350" src="<?php echo $filme['CAMINHO_POSTER']; ?>" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>

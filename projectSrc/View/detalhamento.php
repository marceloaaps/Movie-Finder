<?php
require_once '../Controller/auth_check.php';
require_once '../DAO/database/db_connect.php';
require_once '../DAO/DadosUsuario.php';
require_once '../DAO/database/buscar_filmes.php';


$id = $_GET['id'];

class FilmeController {
    public function detalhes($id) {
        global $conn;
        $sql = "SELECT * FROM VW_FILMES_GENEROS WHERE ID_FILME = ?";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet"  href="css/detalhamento.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <header>
        <div class="site-name">Movie Finder</div>
        <nav>
            <div class="left-section">
                <a href="landing.php" class="categoria home-page">Home Page</a>
                <a href="management.php" class="categoria home-page">Gestão</a>
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

    <main>
        <div class="movie-details">
            <div class="movies-scroller">
                <div class="moviebox">
                <?php if (isset($filme['CAMINHO_POSTER'])) : ?>
                    <img src="<?php echo 'https://image.tmdb.org/t/p/w500' . $filme['CAMINHO_POSTER']; ?>" />
          <?php endif; ?>
                    <h1 class="movieMiniName">
                        <?php echo $filme['TITLE'] ?? 'Título não disponível'; ?>
                    </h1>
                    <p class="movieGenre">
                        <?php echo $filme['SINOPSE'] ?? 'Sinopse não disponível'; ?>
                    </p>
                    <p class="movieGenre">
                        <?php echo $filme['ANO_LANCAMENTO'] ?? 'Sinopse não disponível'; ?>
                    </p>
                    <p class="movieGenre">
                        <?php echo $filme['GENEROS'] ?? 'Sinopse não disponível'; ?>
                    </p>
                </div>
                <a href="landing.php" style="display: inline-block; padding: 10px 20px; background-color: white; color: #333; text-decoration: none; border: 1px solid #333; border-radius: 5px;">Voltar</a>
            </div>
        </div>
    </main>
</body>
</html>

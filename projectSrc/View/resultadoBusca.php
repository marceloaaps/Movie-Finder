<?php
require_once '../DAO/BuscarFilmes.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Resultados da Pesquisa</title>
    <link rel="stylesheet" href="css/resultadoBusca.css">
</head>
<body>
    <div class="container">
        <?php
        if ($result->num_rows == 0) {
            echo '<p>Nenhum resultado encontrado</p>';
        } else {
            while ($dados = $result->fetch_assoc()) {
                echo '<div class="movie">';
                echo '<img src="https://image.tmdb.org/t/p/w500' . $dados['CAMINHO_POSTER'] . '" alt="' . $dados['TITLE'] . '">';
                echo '<div class="movie-details">';
                echo '<div class="movie-title">' . $dados['TITLE'] . '</div>';
                echo '<div class="movie-genre">' . $dados['GENEROS'] . '</div>';
                echo '</div>';
                echo '</div>';
            }
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>

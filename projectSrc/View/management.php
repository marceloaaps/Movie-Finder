<!-- Feito por Marcelo -->
<?php
require_once '../DAO/BuscaHeap.php';
require_once '../Controller/auth_check.php';
require_once '../DAO/database/db_connect.php';
require_once '../DAO/DadosUsuario.php';
require_once '../DAO/database/buscar_filmes.php';


$start_year = isset($_POST['start_year']) ? intval($_POST['start_year']) : 2000;
$end_year = isset($_POST['end_year']) ? intval($_POST['end_year']) : 2020;

$films = fetch_films_by_year_range($conn, $start_year, $end_year);

$start_time = microtime(true);
heap_sort($films);
$end_time = microtime(true);
$execution_time = $end_time - $start_time;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="css/management.css">
  <link rel="stylesheet" href="css/navbar.css">
  <script src="js/script.js"></script>
  <title>Gestão Safadosflix</title>
</head>
<body id="background">
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

  <div id="container">
    <div class="containerThings">
      <h1 class="p2">Gestão de Filmes</h1>
        <form class="boxesSearch" method="POST" action="">
          <h1 id="p">Ano de Lançamento: </h1>
          <textarea class="boxText" name="start_year" placeholder="Inicial"><?php echo $start_year; ?></textarea>
          <h1 class="h1H">-</h1>
          <textarea class="boxText" name="end_year" placeholder="Final"><?php echo $end_year; ?></textarea>
          <p class="procTime">Tempo de processamento: <?php echo $execution_time; ?> segundos</p>
          <button class="btnDate" type="submit">Enviar</button>
        </form>
      <table class="dataTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Data</th>
            <th>Descrição</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($films as $film): ?>
            <tr class="table">
              <td><?php echo htmlspecialchars($film['ID_FILME']); ?></td>
              <td><?php echo htmlspecialchars($film['TITLE']); ?></td>
              <td><?php echo htmlspecialchars($film['GENEROS']); ?></td>
              <td><?php echo htmlspecialchars($film['ANO_LANCAMENTO']); ?></td>
              <td><?php echo htmlspecialchars($film['SINOPSE']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
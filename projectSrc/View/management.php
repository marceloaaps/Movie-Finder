<!-- Feito por Marcelo -->
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
    <a href="landing.php" class="categoria home-page">Home Page</a>
    <div class="right-section">
      <a href="#" class="suporte"><a href="perfil.php"><?php echo $user['NOME'];?></a></a>
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
        <div class="boxesSearch">
          <h1 id="p">Ano de Lançamento: </h1>
          <textarea class="boxText" placeholder="Inicial"></textarea>
          <h1 class="h1H">-</h1>
          <textarea class="boxText" placeholder="Final"></textarea>
          <button class="btnDate">Enviar</button>
        </div>
        <table id="dataTable">
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
          </tbody>
        </table>
      </div>
</body>

</html>
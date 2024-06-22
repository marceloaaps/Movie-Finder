<?php
// Define as credenciais do servidor de banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root";        // Nome de usuário do MySQL
$password = "l12345"; // Senha do usuário MySQL
$dbname = "CINEMINHA";     // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    // Se ocorrer um erro na conexão, interrompe a execução do script e exibe uma mensagem de erro
    die("Falha na conexão: " . $conn->connect_error);
}


$id_filme = 'SELECT  ID_FILME  FROM filmes';
$result_filmes = $conn->query($id_filme);
$filems_movies = array();
if ($result_filmes->num_rows > 0) {
    while($row = $result_filmes->fetch_assoc()) {
        $filme_ids[] = $row['ID_FILME'];
    }
}


$id_titulo = 'SELECT  TITLE  FROM filmes';
$result_titulo = $conn->query($id_titulo);
$titulo_movies = array();
if ($result_titulo->num_rows > 0) {
    while($row = $result_titulo->fetch_assoc()) {
        $titulos[] = $row['TITLE'];
    }
}

$ano_lancamento = 'SELECT  ANO_LANCAMENTO  FROM filmes';
$result_lancamento = $conn->query($ano_lancamento);
$lancamento_movies = array();
if ($result_lancamento->num_rows > 0) {
    while($row = $result_lancamento->fetch_assoc()) {
        $lancamentos[] = $row['ANO_LANCAMENTO'];
    }
}

$sinopse = 'SELECT  SINOPSE   FROM filmes';
$result_sinopse = $conn->query($sinopse);
$sinopse_movies = array();
if ($result_sinopse->num_rows > 0) {
    while($row = $result_sinopse->fetch_assoc()) {
        $sinopses[] = $row['SINOPSE'];
    }
}

$caminho_poster = 'SELECT  CAMINHO_POSTER  FROM filmes';
$result_poster = $conn->query($caminho_poster);
$poster_movies = array();
if ($result_poster->num_rows > 0) {
    while($row = $result_poster->fetch_assoc()) {
        $posters[] = $row['CAMINHO_POSTER'];
    }
}


$genero = 'SELECT DS_NOME FROM generos';
$result_genero = $conn->query($genero);
$genero_movies = array();
if ($result_genero->num_rows > 0) {
    while($row = $result_genero->fetch_assoc()) {
        $genero_movies[] = $row['DS_NOME'];
    }
}

$conn->close();


?>
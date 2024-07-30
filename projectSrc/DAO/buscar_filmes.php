<?php
// Define as credenciais do servidor de banco de dados
require_once '../DAO/db_connect.php';

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    // Se ocorrer um erro na conexão, interrompe a execução do script e exibe uma mensagem de erro
    die("Falha na conexão: " . $conn->connect_error);
}



$sql = "SELECT ID_FILME, TITLE, ANO_LANCAMENTO, SINOPSE, GENEROS, CAMINHO_POSTER FROM VW_FILMES_GENEROS";

$result = $conn->query($sql);

$id_filme = array();
$titulo = array();
$ano_lancamento = array();
$sinopse = array();
$generos = array();
$filmes = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $filme = array(
            "ID_FILME" => $row['ID_FILME'],
            "TITLE" => $row['TITLE'],
            "GENEROS" => $row['GENEROS'],
            "ANO_LANCAMENTO" => $row['ANO_LANCAMENTO'],
            "SINOPSE" => $row ['SINOPSE'],
            "CAMINHO_POSTER" => 'https://image.tmdb.org/t/p/w500' . $row['CAMINHO_POSTER']
        );

        $filmes[] = $filme;
        $id_filme[] = $filme;
        $ano_lancamento[] = $filme;
        $sinopse[] = $filme;
        $titulo[] = $filme;
        $generos[] = $filme;
    }
}

?>
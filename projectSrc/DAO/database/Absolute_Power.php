<?php
require_once '../DAO/database/db_connect.php';
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
$sql = "SELECT 
    ID_FILME,
    TITLE,
    ANO_LANCAMENTO,
    SINOPSE,
    GENEROS,
    CAMINHO_POSTER 
FROM VW_FILMES_GENEROS 
WHERE ID_FILME = 66";
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
            "ANO_LANCAMENTO" => $row['ANO_LANCAMENTO'],
            "SINOPSE" => $row ['SINOPSE'],
            "GENEROS" => $row['GENEROS'],
            "CAMINHO_POSTER" => 'https://image.tmdb.org/t/p/w500' . $row['CAMINHO_POSTER']
        );

        $filmes[] = $filme;
        $id_filme[] = $filme;
        $titulo[] = $filme;
        $ano_lancamento[] = $filme;
        $sinopse[] = $filme;
        $generos[] = $filme;
    }
}
?>
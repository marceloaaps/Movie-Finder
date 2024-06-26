<?php
require_once '../DAO/database/db_connect.php';


$pesquisa = $_POST['busca'];

// Verifique se a conexão com o banco de dados foi estabelecida corretamente
if (!$conn) {
    die("Conexão com o banco de dados falhou: " . $conn->connect_error);
}

// Usando declarações preparadas para segurança contra injeção de SQL
$stmt = $conn->prepare("SELECT * FROM vw_filmes_generos WHERE TITLE LIKE ?");
if ($stmt === false) {
    die("Erro na preparação da consulta: " . $conn->error);
}

$like_pesquisa = "%" . $pesquisa . "%";
$stmt->bind_param("s", $like_pesquisa);

$stmt->execute();
$result = $stmt->get_result();



function fetch_films_by_year_range($conn, $start_year, $end_year) {
    $sql = "SELECT f.ID_FILME, f.TITLE, f.ANO_LANCAMENTO, f.SINOPSE, f.CAMINHO_POSTER, GROUP_CONCAT(g.DS_NOME SEPARATOR ', ') AS GENEROS
            FROM FILMES f
            JOIN FILME_GENERO fg ON f.ID_FILME = fg.ID_FILME
            JOIN GENEROS g ON fg.ID_GENERO = g.ID_GENERO
            WHERE YEAR(f.ANO_LANCAMENTO) BETWEEN ? AND ?
            GROUP BY f.ID_FILME";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $start_year, $end_year);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $films = [];
    while ($row = $result->fetch_assoc()) {
        $films[] = $row;
    }
    return $films;
}

function heapify(&$array, $n, $i) {
    $largest = $i;
    $left = 2 * $i + 1;
    $right = 2 * $i + 2;

    if ($left < $n && $array[$left]['ANO_LANCAMENTO'] > $array[$largest]['ANO_LANCAMENTO']) {
        $largest = $left;
    }

    if ($right < $n && $array[$right]['ANO_LANCAMENTO'] > $array[$largest]['ANO_LANCAMENTO']) {
        $largest = $right;
    }

    if ($largest != $i) {
        $temp = $array[$i];
        $array[$i] = $array[$largest];
        $array[$largest] = $temp;

        heapify($array, $n, $largest);
    }
}

function heap_sort(&$array) {
    $n = count($array);

    for ($i = $n / 2 - 1; $i >= 0; $i--) {
        heapify($array, $n, $i);
    }

    for ($i = $n - 1; $i > 0; $i--) {
        $temp = $array[0];
        $array[0] = $array[$i];
        $array[$i] = $temp;

        heapify($array, $i, 0);
    }
}
?>
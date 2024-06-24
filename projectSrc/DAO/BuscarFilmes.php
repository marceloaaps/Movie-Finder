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

if ($result->num_rows == 0) {
    echo 'Nenhum resultado encontrado';
} else {
    while ($dados = $result->fetch_assoc()) {
        // Processar os dados conforme necessário
        echo 'Título: ' . $dados['TITLE'] . '<br>';
        // Adicione mais campos conforme necessário
    }
}

$stmt->close();
$conn->close();
?>

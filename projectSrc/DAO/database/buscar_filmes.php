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

$sql = "SELECT ID_FILME, TITLE, imANO_LANCAMENTO, SINOPESE, CAMINHO_POSTER FROM movies";
$result = $conn->query($sql);

$movies = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $movies[] = $row;
    }
} 

$conn->close();

echo json_encode($movies);
?>
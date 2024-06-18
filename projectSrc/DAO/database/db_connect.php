<?php
// Define as credenciais do servidor de banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root";        // Nome de usuário do MySQL
$password = "Admin-123456"; // Senha do usuário MySQL
$dbname = "CINEMINHA";     // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    // Se ocorrer um erro na conexão, interrompe a execução do script e exibe uma mensagem de erro
    die("Falha na conexão: " . $conn->connect_error);
}
?>

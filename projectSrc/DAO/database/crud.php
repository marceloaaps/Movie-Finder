<?php
// Define as credenciais do servidor de banco de dados
$servername = "localhost"; // Endereço do servidor MySQL
$username = "root";        // Nome de usuário do MySQL
$password = "1234"; // Senha do usuário MySQL
$dbname = "CINEMINHA";     // Nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    // Se ocorrer um erro na conexão, interrompe a execução do script e exibe uma mensagem de erro
    die("Falha na conexão: " . $conn->connect_error);
}

function inserirCinema($conn, $nome, $endereco, $telefone) {
    $sql = "INSERT INTO Cinema (nome, endereco, telefone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nome, $endereco, $telefone);
    if ($stmt->execute()) {
        echo "Novo cinema inserido com sucesso.";
    } else {
        echo "Erro ao inserir cinema: " . $stmt->error;
    }
    $stmt->close();
}

function atualizarCinema($conn, $id, $nome, $endereco, $telefone) {
    $sql = "UPDATE Cinema SET nome=?, endereco=?, telefone=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $endereco, $telefone, $id);
    if ($stmt->execute()) {
        echo "Cinema atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar cinema: " . $stmt->error;
    }
    $stmt->close();
}

function deletarCinema($conn, $id) {
    $sql = "DELETE FROM Cinema WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Cinema deletado com sucesso.";
    } else {
        echo "Erro ao deletar cinema: " . $stmt->error;
    }
    $stmt->close();
}

function listarCinemas($conn) {
    $sql = "SELECT id, nome, endereco, telefone FROM Cinema";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Nome: " . $row["nome"]. " - Endereço: " . $row["endereco"]. " - Telefone: " . $row["telefone"]. "<br>";
        }
    } else {
        echo "0 resultados";
    }
}

?>
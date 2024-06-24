<?php
// echo "<pre>";
// print_r($_POST);

// echo "</pre>";

require_once '../DAO/database/db_connect.php';
require_once '../Controller/auth_check.php';
require_once '../DAO/DadosUsuario.php';
$id = $user['ID_USUARIO'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $data_nascimento = $_POST['data_nascimento'];
    $plano = $_POST['plano'];

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Adicionando logs de depuração
    error_log("ID: $id");
    error_log("Nome: $nome");
    error_log("Senha: $senha");
    error_log("Email: $email");
    error_log("Telefone: $telefone");
    error_log("Endereço: $endereco");
    error_log("Cidade: $cidade");
    error_log("Estado: $estado");
    error_log("Data de Nascimento: $data_nascimento");
    error_log("Plano: $plano");

    $sql = "UPDATE USUARIOS SET NOME=?, SENHA=?, EMAIL=?, TELEFONE=?, ENDERECO=?, CIDADE=?, ESTADO=?, DATA_NASCIMENTO=?, PLANO=? WHERE ID_USUARIO=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssi", $nome, $senha_hash, $email, $telefone, $endereco, $cidade, $estado, $data_nascimento, $plano, $id);
    
    if ($stmt->execute()) {
        // Verifica quantas linhas foram afetadas
        if ($stmt->affected_rows > 0) {
            echo "<script>";
            echo "alert('Perfil atualizado com sucesso!');";
            echo "setTimeout(function() { window.location.href = '../View/perfil.php'; }, 2);"; // Redireciona após 2 milesegundos
            echo "</script>";
        } else {
            echo "Nenhuma alteração foi feita no perfil.";
        }
    } else {
        echo "Erro ao atualizar o perfil: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
}
?>

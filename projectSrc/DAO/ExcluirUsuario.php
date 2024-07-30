<?php
    require_once '../DAO/db_connect.php';
    require_once '../Controller/auth_check.php';
    require_once '../DAO/DadosUsuario.php';
    $id_usuario = $user['ID_USUARIO'];

    // SQL para deletar usuário
    $sql = "DELETE FROM USUARIOS WHERE ID_USUARIO = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Vincular parâmetros
        $stmt->bind_param("i", $id_usuario); // "i" indica que é um parâmetro do tipo inteiro

        // Executar o comando preparado
        $stmt->execute();

        // Verificar se a deleção foi bem sucedida
        if ($stmt->affected_rows > 0) {
            echo "<script>";
            echo "alert('Usuário deletado com sucesso.');";
            echo "setTimeout(function() { window.location.href = '../View/login.php'; }, 2);"; // Redireciona após 2 milesegundos
            echo "</script>";
        } else {
            echo "<script>";
            echo "alert('Nenhum usuário foi deletado.');";
            echo "setTimeout(function() { window.location.href = '../View/perfil.php'; }, 2);"; // Redireciona após 2 milesegundos
            echo "</script>";
        }

        // Fechar statement
        $stmt->close();
    } else {
        echo "Erro ao preparar o statement: " . $conn->error;
    }




?>
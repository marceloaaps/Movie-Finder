<?php
require_once '../DAO/database/db_connect.php';
require_once '../DAO/UsuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Coletar dados do formulário de login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criar uma nova instância de UsuarioDAO passando a conexão
    $usuarioDAO = new UsuarioDAO($conn);

    // Verificar se o e-mail está cadastrado
    if ($usuarioDAO->emailExiste($email)) {
        // Autenticar o usuário
        if ($usuarioDAO->autenticar($email, $senha)) {
            // Iniciar a sessão
            session_start();

            // Armazenar o email na sessão
            $_SESSION['email'] = $email;

            // Redirecionar para página principal após login
            header('Location: ../View/landing.php');
            exit();
        } else {
            header('Location: ../View/login.php');
        }
    } else {
        header('Location: ../View/login.php');

    }
}

?>
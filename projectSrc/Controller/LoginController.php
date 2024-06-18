<?php
require_once '../DAO/database/db_connect.php';
require_once '../DAO/UsuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Coletar dados do formulário de login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criar uma nova instância de UsuarioDAO e autenticar o usuário
    $usuarioDAO = new UsuarioDAO($conn);
    if ($usuarioDAO->autenticar($email, $senha)) {
        echo "<script>alert('Login efetuado com sucesso!');</script>";
        // Redirecionar para página principal ou outra ação após login
    } else {
        echo "<script>alert('Credenciais inválidas.');</script>";
        // Redirecionar de volta à página de login com mensagem de erro
    }
} else {
    echo "Método de requisição inválido.";
}
?>

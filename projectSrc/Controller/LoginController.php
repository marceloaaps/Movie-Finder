<?php
require_once '../DAO/database/db_connect.php';
require_once '../DAO/UsuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Coletar dados do formulário de login
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criar uma nova instância de UsuarioDAO
    $usuarioDAO = new UsuarioDAO($conn);

    // Verificar se o e-mail está cadastrado
    if ($usuarioDAO->emailExiste($email)) {
        // Autenticar o usuário
        if ($usuarioDAO->autenticar($email, $senha)) {
            echo "<script>alert('Login efetuado com sucesso!');</script>";
            // Redirecionar para página principal ou outra ação após login
        } else {
            echo "<script>alert('Credenciais inválidas.');</script>";
            // Redirecionar de volta à página de login com mensagem de erro
        }
    } else {
        echo "<script>alert('E-mail não cadastrado.');</script>";
    }
} else {
    echo "Método de requisição inválido.";
}
?>

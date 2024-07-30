<?php
require_once '../DAO/db_connect.php';
require_once '../Model/Usuario.php';
require_once '../DAO/UsuarioDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $plano = $_POST['plano'];
    $dataNascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    // Criar uma nova instância de Usuario
    $usuario = new Usuario();
    $usuario->setNome($nome);
    $usuario->setEmail($email);
    $usuario->setTelefone($telefone);
    $usuario->setSenha($senha);
    $usuario->setPlano($plano);
    $usuario->setDataNascimento($dataNascimento);
    $usuario->setCidade($cidade);
    $usuario->setEstado($estado);
    $usuario->setEndereco($endereco);

    // Criar uma nova instância de UsuarioDAO
    $usuarioDAO = new UsuarioDAO($conn);

    // Verificar se o e-mail já está cadastrado
    if ($usuarioDAO->emailExiste($email)) {
        echo "<script>alert('E-mail já cadastrado. Por favor, utilize outro e-mail.');</script>";
    } else {
        // Salvar o usuário se o e-mail não estiver cadastrado
        if ($usuarioDAO->salvar($usuario)) {
            echo "<script>";
            echo "alert('Usuário salvo com sucesso!');";
            echo "setTimeout(function() { window.location.href = '../View/login.php'; }, 2);"; // Redireciona após 2 milesegundos
            echo "</script>";

        } else {
            echo "<script>alert('Erro ao registrar o usuário no banco de dados.');</script>";
        }
    }
} else {
    echo "Método de requisição inválido.";
}
?>

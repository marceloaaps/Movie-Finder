<?php
require_once '../Controller/auth_check.php';
require_once '../DAO/DadosUsuario.php';

$data_nascimento = new DateTime($user['DATA_NASCIMENTO']);
$hoje = new DateTime();
$idade = $hoje->diff($data_nascimento)->y; // Calcula a diferença em anos
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário - Movie Finder</title>
    <link rel="stylesheet" href="css/perfil.css">
</head>

<body>
    <div class="container">
        <div class="profile-left">
            <div class="avatar">
                <img id="profileImage" src="https://via.placeholder.com/150" alt="Foto do Usuário">
            </div>
            <div class="user-info">
                <p><strong><?php echo $user['NOME']; ?></strong></p>
                <p><strong><?php echo $user['EMAIL']; ?></strong></p>
                <p><strong><?php echo "Plano: " . $user['PLANO']; ?></strong></p>
                <p><strong><?php echo $idade; ?></strong></p>
            </div>
            <textarea id="bioTextarea" class="bio" placeholder="O seu espaço de ser você..."></textarea>
            <div class="account-buttons">
                <button class="btn-back" onclick="window.location.href='landing.php'">Voltar</button>
                <form action="../DAO/ExcluirUsuario.php" method="post">
                    <button type="submit" class="btn-delete-account" >Excluir Conta</button>
                </form>
            </div>
        </div>
        <div class="profile-right">
            <form id="profileForm" method="post" action="../DAO/EditarDados.php">
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" id="name" name="nome" placeholder="Digite seu nome" value="<?php echo $user['NOME']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="senha" placeholder="Digite sua senha" value="" required>
                </div>
                <div class="form-group">
                    <label for="password">Repita a Senha</label>
                    <input type="password" id="confirmPassword" name="confirm_senha" placeholder="Repita sua senha" value="" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" value="<?php echo $user['EMAIL']; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="tel" id="phone" name="telefone" placeholder="Digite seu telefone" value="<?php echo $user['TELEFONE']; ?>">
                </div>
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" id="address" name="endereco" placeholder="Digite seu endereço" value="<?php echo $user['ENDERECO']; ?>">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" placeholder="Digite sua cidade" value="<?php echo $user['CIDADE']; ?>">
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="estado" placeholder="Digite seu estado" value="<?php echo $user['ESTADO']; ?>">
                </div>
                <div class="form-group">
                    <label for="dob">Data de Nascimento</label>
                    <input type="date" id="dob" name="data_nascimento" value="<?php echo $user['DATA_NASCIMENTO']; ?>">
                </div>
                <div class="form-group plano-group">
                    <label>Tipo de Plano</label>
                    <div class="radio-group">
                        <input type="radio" id="mensal" name="plano" value="mensal" required <?php if ($user['PLANO'] == 'mensal') echo 'checked'; ?>>
                        <label for="mensal">Mensal = 25,99</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" id="bimestral" name="plano" value="bimestral" required <?php if ($user['PLANO'] == 'bimestral') echo 'checked'; ?>>
                        <label for="bimestral">Bimestral = 20,99</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" id="anual" name="plano" value="anual" required <?php if ($user['PLANO'] == 'anual') echo 'checked'; ?>>
                        <label for="anual">Anual = 15,99</label>
                    </div>
                </div>
                <button type="submit" class="btn-update">Atualizar Informações</button>
            </form>
        </div>
    </div>
    <script>
    // Função para verificar se as senhas coincidem
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmPassword").value;

        if (password != confirmPassword) {
            alert("As senhas não coincidem!");
            return false; // Impede o envio do formulário
        }
        return true; // Permite o envio do formulário
    }

    // Adiciona um listener para o evento de submit do formulário
    document.getElementById("profileForm").addEventListener("submit", function(event) {
        if (!validatePassword()) {
            event.preventDefault(); // Impede o envio do formulário se as senhas não coincidirem
        }
    });
</script>
</body>
</html>


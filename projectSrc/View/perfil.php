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
                <input type="file" id="uploadInput" style="display: none;">
                <div class="button-group">
                    <button class="btn-upload" onclick="document.getElementById('uploadInput').click()">Alterar Foto</button>
                    <button class="btn-remove" onclick="removePhoto()">Remover Foto</button>
                </div>
            </div>
            <div class="user-info">
                <p><strong><?php echo $user['NOME']; ?></strong></p>
                <p><strong><?php echo $user['EMAIL']; ?></strong></p>
                <p><strong><?php echo "Plano: ",$user['PLANO']; ?></strong></p>
                <p><strong><?php echo $idade; ?></strong></p>
            </div>
            <textarea id="bioTextarea" class="bio" placeholder="O seu espaço de ser você..."></textarea>
            <div class="account-buttons">
                <button class="btn-back" onclick="voltar()"><a href="landing.php">Voltar</a></button>
                <button class="btn-delete-account" onclick="excluirConta()">Excluir Conta</button>
            </div>
        </div>
        <div class="profile-right">
            <form id="profileForm">
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" id="name" placeholder="Digite seu nome" value="<?php echo $user['NOME']; ?>">
                </div>
                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" placeholder="Digite sua senha" value="<?php echo $user['SENHA']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" placeholder="Digite seu email" value="<?php echo $user['EMAIL']; ?>">
                </div>
                <div class="form-group">
                    <label for="phone">Telefone</label>
                    <input type="tel" id="phone" placeholder="Digite seu telefone" value="<?php echo $user['TELEFONE']; ?>">
                </div>
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" id="address" placeholder="Digite seu endereço" value="<?php echo $user['ENDERECO']; ?>">
                </div>
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" placeholder="Digite sua cidade" value="<?php echo $user['CIDADE']; ?>">
                </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" placeholder="Digite seu estado" value="<?php echo $user['ESTADO']; ?>">
                </div>
                <div class="form-group">
                    <label for="dob">Data de Nascimento</label>
                    <input type="date" id="dob" value="<?php echo ($user['DATA_NASCIMENTO']); ?>"
                    >
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
        document.getElementById('uploadInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        function removePhoto() {
            document.getElementById('profileImage').src = 'https://via.placeholder.com/150';
        }

        function excluirConta() {
            alert('Conta excluída!');
        }

        function voltar() {
            window.location.href = 'http://localhost/trabalho/movieFinder/projectSrc/View/landing.php';
            
        }

        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Informações atualizadas!');
        });
    </script>
</body>
</html>

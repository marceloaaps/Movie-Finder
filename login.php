<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela login</title>
    <link rel="stylesheet" href="./projectSrc/View/css/login_page.css">
</head>

<body>
    <main class="apresentacao">
        <section class="login_form">
            <form action="../Controller/LoginController.php" method="POST">
                <h1>FAÇA SEU LOGIN AQUI</h1>
                <div class="email_form">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="password_form">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="form-enviar">
                    <button type="submit" name="login">Enviar</button>
                </div>
                <div class="info_form">
                    <div class="form-checkbox">
                        <label>Esqueceu a senha?</label>
                        <a href="#">Clique aqui</a>
                    </div>
                    <div class="form-cds">
                        <label>Não tem cadastro?</label>
                        <a href="../View/cadastro.html">Clique aqui para se registrar</a>
                    </div>
                </div>
                </div>
            </form>
        </section>

        <section class="apresentacao_images">
            <div class="images_nome">
                <h2>FAÇA SEU LOGIN E APROVEITE<br>
                    100% DO STREAMING</h2>
            </div>

            <div class="images">
                <div class="images_notebook">
                    <img src="img/laptop.png">
                </div>
                <div class="images_smartphone">
                    <img src="img/smartphone.png">
                </div>
                <div class="images_tv">
                    <img src="img/tv.png">
                </div>
                <div class="images_film">
                    <img src="img/movie.png">
                </div>
            </div>
        </section>
    </main>
</body>

</html>
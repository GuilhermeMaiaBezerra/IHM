<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style/style.css" />
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
</head>

<body class="LoginPage">
    <div class="quadrado">
        <form>
            <h1 id="TituloLogin">Login</h1>
            <hr />

            <div class="input-group">
                <label for="user">Seu usuário</label>
                <input type="text" id="user" placeholder="FOFINHO" />
            </div>

            <div class="input-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" placeholder="Digite sua senha" />
            </div>

            <div class="input-group checkbox-group">
                <input type="checkbox" id="manter" />
                <label for="manter">Manter logado</label>
                <a href="#" class="create">Crie sua conta</a>
            </div>
            <div class="input-group">
                
            </div>
            <button type="button" onclick="window.location.href='pages/home.php'">
                Entrar
            </button>

        </form>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chocolateria</title>
</head>
<body>
    <h1>Login - Chocolateria</h1>
    <form action="fazerLogin.php" method="POST">
        <input type="text" name="login" placeholder="Login:">
        <br>
        <input type="password" name="senha" placeholder="Senha:">
        <br>
        <button type="submit">Entrar</button>
        <p>Ainda não tem uma conta? <a href="cadastro.php">Cadastre-se!</a></p>
    </form>
</body>
</html>
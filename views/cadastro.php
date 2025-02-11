<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Chocolateria</title>
</head>
<body>
    <h1>Cadastro - Chocolateria</h1>

    <form id="cadastroForm" action="fazerCadastro.php" method="POST" onsubmit="validarFormulario(event)">
        <input type="text" name="login" placeholder="Login:" required>
        <br>
        <input type="password" name="senha" id="senha" placeholder="Senha:" required>
        <br>
        <input type="password" name="confirmasenha" id="confirmasenha" placeholder="Confirme sua senha:" required>
        <br>
        <span id="mensagemErro"></span>  
        <br>
        <button type="submit">Entrar</button>
    </form>

    <p>Já tem conta? <a href="login.php">Entre!</a></p>

    <script>
        function validarFormulario(event) {
            let senha = document.getElementById('senha').value;
            let confirmasenha = document.getElementById('confirmasenha').value;
            let mensagemErro = document.getElementById('mensagemErro');

            if (senha !== confirmasenha) {
                mensagemErro.textContent = "As senhas não coincidem!";
                mensagemErro.style.color = "red";
                event.preventDefault();
            } else {
                mensagemErro.textContent = "Conta criada com sucesso! Por favor, faça o login!";
                mensagemErro.style.color = "green";
                event.preventDefault(); 
                
                setTimeout(function() {
                    document.getElementById('cadastroForm').submit(); 
                }, 3000);
            }
        }
    </script>
</body>
</html>

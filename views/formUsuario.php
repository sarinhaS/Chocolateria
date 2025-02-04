<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolateria</title>
</head>
<body>
    <?php include("includes/menu.php");?>
    <h1>Chocolateria - Usuários</h1>
    <a href="usuarios.php">Voltar</a>
    <form action="salvarUsuario.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">
        <input type="text" name="login" placeholder="Login: " value="<?php echo $usuario->getLogin(); ?>">
        <br>
        <input type="password" name="senha" placeholder="Senha: ">
        <br>
        <?php if(!empty($usuario->getId())) {?>
            <span>Para deixar a senha atual, basta deixar o campo em branco</span>
            <br>
        <?php }?>
        <br>

        <select name="nivel">
            <option value="1"  <?php echo ($usuario->getNivel()==1) ? 'SELECTED' : '';?>>Nível 1</option>
            <option value="2" <?php echo ($usuario->getNivel()==2) ? 'SELECTED' : '';?>>Nível 2</option>
        </select>
        <br>

        <button type='submit'>Salvar</button>
    </form>
</body>
</html>
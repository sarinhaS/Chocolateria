<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
    <?php include("includes/menu.php");?>
    <h1>Lista de Usuários</h1>
    <a href="usuario.php">Inserir novo usuário</a>
    <table border=1>
        <tr>
            <th>ID</th>
            <th>Login</th>
            <th>Nível</th>
            <th>Ações</th>
        </tr>
        <?php foreach($usuarios as $usuario){ ?>
            <tr>
                <td><?php echo $usuario->getId(); ?></td>
                <td><?php echo $usuario->getLogin(); ?></td>
                <td><?php echo $usuario->getNivel(); ?></td>
                <td>
                    <a href="usuario.php?id=<?php echo $usuario->getId(); ?>">Editar</a> 
                    <br>
                    <a href="excluirUsuario.php?id=<?php echo $usuario->getId(); ?>">Excluir</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
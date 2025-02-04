<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Formulário de Categoria</title>
</head>
<body>

<h1><?php echo empty($categoria->getId()) ? 'Adicionar Categoria' : 'Editar Categoria'; ?></h1>

<form action="salvarCategoria.php" method="post">
    <input type="hidden" name="id" value="<?php echo $categoria->getId(); ?>">

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($categoria->getNome()); ?>" required>

    <button type="submit">Salvar</button>
    <a href="categorias.php">Cancelar</a>
</form>

</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolateria</title>
</head>
<body>
    <?php include("includes/menu.php");?>
    <h1>Chocolateria - Novo produto</h1>
    <a href="produtos.php">Voltar para a listagem</a>
    <form action="salvarProduto.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $produto->getId(); ?>">
        <input type="text" name="nome" value="<?php echo $produto->getNome(); ?>" placeholder="Nome:">
        <br>
        <label for="id_categoria">Categoria</label>
        <select name="id_categoria" id="id_categoria">
            <?php foreach ($categorias as $categoria) { ?>
                <option value="<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNome(); ?></option>
            <?php } ?>
        </select> <br>

        
        <label for="Descricao">Descrição:</label>
        <input type="text" name="descricao" value="<?php echo $produto->getDescricao(); ?>" placeholder="Descrição:">
        <br>
        <label for="preco">Preço: </label>
        <input type="number" name="preco" value="<?php echo $produto->getPreco(); ?>" placeholder="Preço: ">
        <br>
        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto">
        <br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
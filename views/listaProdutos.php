<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
</head>
<body>
    <?php include("includes/menu.php");?>

    <h1>Lista de Produtos</h1>
    <?php if($_SESSION["usuario"]->getNivel() ==1 ){ echo "<a href=\"produto.php\">Adicionar Novo Produto</a>"; } ?>

    <table border="1">
        <thead>
            <tr>
                <?php if($_SESSION["usuario"]->getNivel() ==1 ){
                    echo "<th>ID</th>";
                    echo "<th>Categoria</th>";
                }?>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Foto</th>
                <?php if($_SESSION["usuario"]->getNivel() == 1) { ?>
                    <th>Ações</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($produto as $pr) { ?>
        <tr>
                <?php if($_SESSION["usuario"]->getNivel() == 1) { ?>
                    <td><?php echo $pr->getId(); ?></td>
                    <td><?php echo $pr->getIdCategoria(); ?></td>
                <?php } ?>

            <td><?php echo $pr->getNome(); ?></td>
            <td><?php echo $pr->getDescricao(); ?></td>
            <td><?php echo $pr->getPreco(); ?></td>
            <td>
                <?php if ($pr->getFoto()) { ?>
                    <img src="uploads\<?php echo $pr->getFoto(); ?>" alt="<?php echo $pr->getNome(); ?>" style="max-width: 100px">
                <?php } ?>
            </td>
            <?php if($_SESSION["usuario"]->getNivel() == 1) { ?>
                <td>
                    <a href="produto.php?id=<?php echo $pr->getId(); ?>">Editar</a>
                    <a href="excluirproduto.php?id=<?php echo $pr->getId(); ?>">Remover</a>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>

        </tbody>
    </table>

</body>
</html>

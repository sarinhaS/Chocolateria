<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Categorias</title>
</head>
<body>
    <?php include("includes/menu.php");?>
    <h1>Lista de Categorias</h1>

    <?php 
        if($_SESSION["usuario"]->getNivel() == 1){
            echo "<a href=\"categorias.php?action=form\">Adicionar Nova Categoria</a>";
        }
    
    ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <?php if($_SESSION['usuario']->getNivel() == 1) {echo "<th>Ações</th>"; } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td><?php echo $categoria->getId(); ?></td>
                    <td><?php echo $categoria->getNome(); ?></td>
                    <?php 
                        if($_SESSION["usuario"]->getNivel() ==1 ){
                            echo "<td>";
                            echo "<a href=\"categorias.php?id=" . $categoria->getId() . "\">Editar </a>";
                            echo "<a href=\"excluirCategoria.php?id=" . $categoria->getId() . "\"> Remover</a>";
                            echo "</td>";
                        }
                    
                    ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

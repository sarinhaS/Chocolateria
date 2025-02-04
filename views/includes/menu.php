<ul>
    <li><a href="produtos.php">Produtos</a></li>
    <li><a href="index.php">Categorias</a></li>
    <?php 
        if($_SESSION["usuario"]->getNivel()==2){
            echo "";
        }else if($_SESSION["usuario"]->getNivel()==1){
            echo "<li><a href=\"usuarios.php\">Usuários</a></li>";
        }
    
    ?>
    <li><a href="logout.php">Sair</a></li>
</ul>
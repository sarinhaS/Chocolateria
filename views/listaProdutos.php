<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="stylejs.css">
</head>
<body>
<?php include("includes/menu.php");?>
<div class="container">
    <header>
        <div class="title">PRODUCT LIST</div>
        <div class="icon-cart">
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
            </svg>
            <span>0</span>
        </div>
    </header>

    <div class="listProduct">
        <?php
        // Conexão com o banco de dados
        $host = "localhost";
        $dbname = "Chocolateria";
        $username = "root";
        $password = "";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT id, nome, preco, foto FROM produtos");
            $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($produtos as $produto): ?>
                <div class="item" data-id="<?= $produto['id']; ?>">
                    <img src="uploads/<?= htmlspecialchars($produto['foto']); ?>" alt="<?= htmlspecialchars($produto['nome']); ?>">
                    <h2><?= htmlspecialchars($produto['nome']); ?></h2>
                    <div class="price">$<?= number_format($produto['preco'], 2); ?></div>
                    <button class="addCart">Add To Cart</button>
                </div>
            <?php endforeach;

        } catch (PDOException $e) {
            echo "<p>Erro ao carregar produtos: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
</div>

<div class="cartTab">
    <h1>Shopping Cart</h1>
    <div class="listCart"></div>
    <div class="btn">
        <button class="close">CLOSE</button>
        <button class="checkOut">Check Out</button>
    </div>
</div>

<script src="carrinho.js"></script>
</body>
</html>

<?php

require_once("includes/init.php");

$popular = Product::Find();
usort($popular, $sortMethods["popularity"]["sort"]);

$new = Product::Find();
usort($new, $sortMethods["release"]["sort"]);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/_index.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
            <section class="popular">
                <h2>Nos produits en vogue</h2>
                <div class="item-showcase">
                    <?php foreach (array_slice($popular, 0, 3) as $product) { ?>
                        <a class="product" href="product.php?id=<?= $product->getId() ?>">
                            <img src="img/<?= $product->getImagePath() ?>">
                            <h3><?= $product->getName() ?></h3>
                            <p><?= $product->getDescription() ?></p>
                            <p><?= number_format($product->getPrice()) ?> Rubis</p>
                        </a>
                    <?php } ?>
                </div>
            </section>

            <section class="new">
                <h2>Nos nouveaux produits</h2>
                <div class="item-showcase">
                    <?php foreach (array_slice($new, 0, 3) as $product) { ?>
                        <a class="product" href="product.php?id=<?= $product->getId() ?>">
                            <img src="img/<?= $product->getImagePath() ?>">
                            <h3><?= $product->getName() ?></h3>
                            <p><?= $product->getDescription() ?></p>
                            <p><?= number_format($product->getPrice()) ?> Rubis</p>
                        </a>
                    <?php } ?>
                </div>
            </section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

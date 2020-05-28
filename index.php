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
            <section class="presentation">
                <h2>Bienvenue sur la boutique de Terry</h2>
                <p class="text">
                    Lassé de devoir parcourir Hyrule à la recherche de client, Terry décide de se mettre à la page pour proposer ses articles à tous, même ceux qui sont loins !
                    Voici donc sa boutique en ligne, qui ne ressemble certes pas à un scarabée mais qui auras le mérite de vous proposer tout ce dont vous pourriez avoir besoin.
                </p>
            </section>
            <section class="popular">
                <h2>Nos produits en vogue</h2>
                <div class="item-showcase">
                    <?php foreach (array_slice($popular, 0, 3) as $product) { ?>
                        <a class="pro product" href="product.php?id=<?= $product->getId() ?>">
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
                        <a class="pro product" href="product.php?id=<?= $product->getId() ?>">
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

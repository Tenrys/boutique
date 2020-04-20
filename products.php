<?php

require_once("includes/init.php");

$categoryId = (string)($_GET["category"] ?? "");
$subcategoryId = (string)($_GET["subcategory"] ?? "");
$sort = (string)($_GET["sort"] ?? "popularity");

$sortMethods = [
    "popularity" => [
        "niceName" => "Popularité",
        "sort" => function($a, $b) {
            $aPop = $a->getRating();
            $bPop = $b->getRating();
            if ($aPop == $bPop) {
                return 0;
            } else if ($aPop < $bPop) {
                return 1;
            } else {
                return -1;
            }
        }
    ],
    "price" => [
        "niceName" => "Prix",
        "sort" => function($a, $b) {
            $aPop = $a->getPrice();
            $bPop = $b->getPrice();
            if ($aPop == $bPop) {
                return 0;
            } else if ($aPop < $bPop) {
                return 1;
            } else {
                return -1;
            }
        }
    ]
];

$categories = Category::Find();
if (is_numeric($categoryId)) {
    $pickedCategory = Category::Get($categoryId);
    if (is_numeric($subcategoryId)) {
        $pickedSubcategory = SubCategory::Get(["id_category" => $categoryId, "id" => $subcategoryId]);
    }

    if (isset($pickedSubcategory) && $pickedSubcategory) {
        $products = $pickedSubcategory->getProducts();
    } else {
        $products = $pickedCategory->getProducts();
    }

    $subcategories = SubCategory::Find(["id_category" => $categoryId]);
}

if (!isset($products)) {
    $products = Product::Find();
}

usort($products, ($sortMethods[$sort] ?? $sortMethods["popularity"])["sort"]);

?>

<html>
    <head>
        <title>Accueil</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main style="display: flex; justify-content: space-between; margin: 0 1em;">
            <section class="produits">
                <div>
                    <p>
                        <span><?= isset($pickedCategory) ? $pickedCategory->getName() : "Tous les produits" ?></span>
                        <?php if (isset($pickedCategory)) { ?>
                            <span><?= $pickedCategory->getDescription() ?></span>
                        <?php } ?>
                    </p>
                    <p>
                    <?php if (isset($pickedSubcategory)) { ?>
                        <span><?= $pickedSubcategory->getName() ?></span>
                        <span><?= $pickedSubcategory->getDescription() ?></span>
                    <?php } ?>
                    </p>
                </div>
                <?php foreach($products as $product) { ?>
                    <a class="produit" href="product.php?id=<?= $product->getDatabaseId() ?>">
                        <img src="img/<?= $product->getImagePath() ?>">
                        <h3><?= $product->getName() ?></h3>
                        <p><?= $product->getDescription() ?></p>
                        <p><?= $product->getPrice() ?> Rubis</p>
                    </a>
                <?php } ?>
            </section>
            <section class="filtre">
                <form method="GET">
                    <p>Filtrer par:</p>
                    <label for="category">Catégorie</label>
                    <select name="category" onchange="this.form.submit()">
                        <option
                            value=""
                            <?= $categoryId ? '' : 'selected' ?>
                        >
                            Toutes
                        </option>

                        <?php foreach ($categories as $category) { ?>
                            <option
                                value="<?= $category->getDatabaseId() ?>"
                                <?= $categoryId == $category->getId() ? 'selected' : '' ?>
                            >
                                <?= $category->getName() ?>
                            </option>
                        <?php } ?>
                    </select>
                    <br>
                    <?php if ($categoryId) { ?>
                        <label for="subcategory">Sous-catégorie</label>
                        <select name="subcategory" onchange="this.form.submit()">
                            <option
                                value=""
                                <?= $categoryId ? '' : 'selected' ?>
                            >
                                Toutes
                            </option>

                            <?php foreach ($subcategories as $subcategory) { ?>
                                <option
                                    value="<?= $subcategory->getDatabaseId() ?>"
                                    <?= $subcategoryId == $subcategory->getId() ? 'selected' : '' ?>
                                >
                                    <?= $subcategory->getName() ?>
                                </option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                    <br>
                    <p>Trier par:</p>
                    <select name="sort" onchange="this.form.submit()">
                        <?php foreach ($sortMethods as $name => $info) { ?>
                            <option
                                value="<?= $name ?>"
                                <?= $sort == $name ? 'selected' : '' ?>
                            >
                                <?= $info["niceName"] ?>
                            </option>
                        <?php } ?>
                    </select>
                </form>
            </section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

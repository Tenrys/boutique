<?php

require_once("includes/init.php");

$categoryId = (string)($_GET["category"] ?? "");
$subcategoryId = (string)($_GET["subcategory"] ?? "");
$sort = (string)($_GET["sort"] ?? "popularity");

$sortMethods = [
    "popularity" => [
        "niceName" => "Popularité",
        "sort" => function($a, $b) {
            $aPop = $a->getPopularity();
            $bPop = $b->getPopularity();
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

        <main>
            <section class="filtre">
                <form method="GET">
                    <label for="category">Catégories</label>
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
                    <?php if ($categoryId) { ?>
                        <label for="subcategory">Sous-catégories</label>
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
                    <label for="sort">Ordre</label>
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
                <?php if (isset($pickedCategory)) { ?>
                    <h1><?= $pickedCategory->getName() ?></h1>
                    <p><?= $pickedCategory->getDescription() ?></p>
                <?php } ?>
                <?php if (isset($pickedSubcategory)) { ?>
                    <h2><?= $pickedSubcategory->getName() ?></h2>
                    <p><?= $pickedSubcategory->getDescription() ?></p>
                <?php } ?>
            </section>
            <section class="produits">
                <?php foreach($products as $product) { ?>
                    <a class="produit" href="product.php?id=<?= $product->getDatabaseId() ?>">
                        <img src="img/<?= $product->getImagePath() ?>">
                        <h3><?= $product->getName() ?></h3>
                        <p><?= $product->getDescription() ?></p>
                        <p><?= $product->getPrice() ?> Rubis</p>
                    </a>
                <?php } ?>
            </section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

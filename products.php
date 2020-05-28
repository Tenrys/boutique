<?php

require_once("includes/init.php");

$categoryId = (string)($_GET["category"] ?? "");
$subcategoryId = (string)($_GET["subcategory"] ?? "");
$sort = (string)($_GET["sort"] ?? "popularity");
$searchQuery = strtolower((string)($_GET["search_query"] ?? ""));

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

if (strlen($searchQuery) > 0) {
    $found = [];

    foreach ($products as $product) {
    	if (strstr(strtolower($product->getName()), $searchQuery) ||
    		strstr(strtolower($product->getDescription()), $searchQuery) &&
    		!in_array($product, $found))
    	{
    		$found[] = $product;
    	}
    }

    $products = $found;
}

usort($products, ($sortMethods[$sort] ?? $sortMethods["popularity"])["sort"]);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Produits</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main id="products">
            <section class="products">
                <div class="title_pro">
                    <?php if (isset($found)) { ?>
                        <p>
                            <h1><?= count($found) ?> résultat<?= count($found) == 1 ? "" : "s" ?> pour "<?= htmlspecialchars($searchQuery) ?>"</h1>
                        </p>
                    <?php } ?>
                    <p>
                        <h1><?= isset($pickedCategory) ? $pickedCategory->getName() : "Tous les produits" ?></h1>
                        <?php if (isset($pickedCategory)) { ?>
                            <span><?= $pickedCategory->getDescription() ?></span>
                        <?php } ?>
                    </p>
                    <p>
                    <?php if (isset($pickedSubcategory)) { ?>
                        <h2><?= $pickedSubcategory->getName() ?></h2>
                        <span><?= $pickedSubcategory->getDescription() ?></span>
                    <?php } ?>
                    </p>
                </div>

                <?php foreach($products as $product) { ?>
                    <div class="pro">
                    <a class="product" href="product.php?id=<?= $product->getId() ?>">
                        <img class="img-pro" src="img/<?= $product->getImagePath() ?>">
                        <h3><?= $product->getName() ?></h3>
                        <p><?= $product->getDescription() ?></p>
                        <p><?= number_format($product->getPrice()) ?> Rubis</p>
                    </a>
                    </div>
                <?php } ?>

            </section>
            <section class="filter">
                <form method="GET" name="filter" id="filter">
                    <h3 >Filtrer par:</h3>
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
                                value="<?= $category->getId() ?>"
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
                                    value="<?= $subcategory->getId() ?>"
                                    <?= $subcategoryId == $subcategory->getId() ? 'selected' : '' ?>
                                >
                                    <?= $subcategory->getName() ?>
                                </option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                    <br>
                    <h3>Trier par:</h3>
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

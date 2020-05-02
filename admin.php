<?php

require_once("includes/init.php");

if (!isset($_SESSION["user"]) || $_SESSION["user"]->getRank() < 1) {
	index();
}

if (isset($_POST["category"])) {
    $_category = $_POST["category"];
    if (isset($_category["insert"])) {
        $category = new Category();
        $category->setName("Nouvelle catégorie");
        $category->setDescription("Une super description");
        Category::Insert($category);
        $selectedCategory = $category->getId();
    } elseif (isset($_category["update"])) {
        if ($category = Category::Get($_category["id"])) {
            $category->setName($_category["name"]);
            $category->setDescription($_category["description"]);
            Category::Update($category);
            $selectedCategory = $category->getId();
        }
    } elseif (isset($_category["delete"])) {
        if ($category = Category::Get($_category["id"])) {
            Category::Delete($category);
        }
    }
} elseif (isset($_POST["subcategory"])) {
    $_subcategory = $_POST["subcategory"];
    if (isset($_subcategory["insert"])) {
        $subcategory = new SubCategory();
        $subcategory->setName("Nouvelle sous-catégorie");
        $subcategory->setDescription("Une super description");
        $subcategory->setCategory(Category::Find()[0]);
        SubCategory::Insert($subcategory);
        $selectedSubcategory = $subcategory->getId();
    } elseif (isset($_subcategory["update"])) {
        if ($subcategory = SubCategory::Get($_subcategory["id"])) {
            $subcategory->setName($_subcategory["name"]);
            $subcategory->setDescription($_subcategory["description"]);
            $subcategory->setCategory($_subcategory["category"]);
            SubCategory::Update($subcategory);
            $selectedCategory = $subcategory->getId();
        }
    } elseif (isset($_subcategory["delete"])) {
        if ($subcategory = Subcategory::Get($_subcategory["id"])) {
            Subcategory::Delete($subcategory);
        }
    }
} elseif (isset($_POST["product"])) {
    $_product = $_POST["product"];
    if (isset($_product["insert"])) {
        $product = new Product();
        $product->setName("Nouveau produit");
        $product->setDescription("Une super description");
        $product->setSubcategory(SubCategory::Find()[0]);
        Product::Insert($product);
        $selectedProduct = $product->getId();
    } elseif (isset($_product["update"])) {
        if ($product = Product::Get($_product["id"])) {
            $product->setName($_product["name"]);
            $product->setDescription($_product["description"]);
            $product->setPrice($_product["price"]);
            $product->setQuantity($_product["quantity"]);
            $product->setSubcategory(SubCategory::Get($_product["subcategory"]));
            if (Product::Update($product) && isset($_FILES["product_img"]) && $_FILES["product_img"]["error"] === 0) {
                $ext = strtolower(pathinfo($_FILES["product_img"]["name"])["extension"]);
                if (in_array($ext, ["jpg", "jpeg", "jpe", "png"])) {
                    $insertId = Item::$db->lastInsertId();
                    $path = __DIR__ . "/img/products/" . $insertId;
                    if (!empty($files = glob($path . ".*"))) {
                        foreach ($files as $file) {
                            unlink($file);
                        }
                    }
                    if (move_uploaded_file($_FILES["product_img"]["tmp_name"], "$path.$ext")) {
                        $product->setImagePath("products/" . $insertId . "." . $ext);
                        Product::Update($product);
                    } else {
                        $message = "Erreur lors du téléchargement du fichier";
                    }
                }
            }
            $selectedProduct = $product->getId();
        }
    } elseif (isset($_product["delete"])) {
        if ($product = Product::Get($_product["id"])) {
            if (file_exists($path = __DIR__ . "/img/" . $product->getImagePath())) {
                unlink($path);
                Product::Delete($product);
            }
        }
    }
}

$categories = Category::Find();
$subcategories = SubCategory::Find();
$products = Product::Find();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Accueil</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/_admin.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
            <h3 class="title-medium">Admin</h3>
			<section class="admin">
			    <?php if (isset($message)) { ?>
			        <p class="alert"><?= $message ?></p>
                <?php } ?>
                <form method="POST">
                    <fieldset class="categories">
                        <legend>Catégories</legend>
                        <div class="container">
                            <div class="fields">
                                <div class="list">
                                    <select name="category[id]">
                                        <?php foreach ($categories as $category) { ?>
                                            <option
                                                value="<?= $category->getId() ?>"
                                                <?= isset($selectedCategory) && $selectedCategory == $category->getId() ? "selected" : "" ?>
                                            >
                                                <?= $category->getName() ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="edit">
                                    <label for="category[name]"><h3><b>Nom</b></h3></label>
                                    <input type="text" name="category[name]">
                                    <label for="category[description]"><h3><b>Description</b></h3></label>
                                    <textarea type="text" name="category[description]" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="actions">
                                <input type="submit" name="category[insert]" value="Nouveau">
                                <input type="submit" name="category[update]" value="Modifier">
                                <input type="submit" name="category[delete]" value="Supprimer" onclick="return confirm('Êtes-vous sur de vouloir supprimer cette catégorie ?')">
                            </div>
                        </div>
                    </fieldset>
                </form>
                <form method="POST">
                    <fieldset class="subcategories">
                        <legend>Sous-catégories</legend>
                        <div class="container">
                            <div class="fields">
                                <div class="list">
                                    <select name="subcategory[id]">
                                        <?php foreach ($subcategories as $subcategory) { ?>
                                            <option
                                                value="<?= $subcategory->getId() ?>"
                                                <?= isset($selectedSubcategory) && $selectedSubcategory == $subcategory->getId() ? "selected" : "" ?>
                                            >
                                                <?= $subcategory->getName() ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="edit">
                                    <label for="subcategory[name]"><h3><b>Nom</b></h3></label>
                                    <input type="text" name="subcategory[name]">
                                    <label for="subcategory[description]"><h3><b>Description</b></h3></label>
                                    <textarea type="text" name="subcategory[description]" rows="5"></textarea>
                                    <label for="subcategory[category]"><h3><b>Catégorie</b></h3></label>
                                    <select name="subcategory[category]">
                                        <?php foreach ($categories as $category) { ?>
                                            <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="actions">
                                <input type="submit" name="subcategory[insert]" value="Nouveau">
                                <input type="submit" name="subcategory[update]" value="Modifier">
                                <input type="submit" name="subcategory[delete]" value="Supprimer" onclick="return confirm('Êtes-vous sur de vouloir supprimer cette sous-catégorie ?')">
                            </div>
                        </div>
                    </fieldset>
                </form>
                <form method="POST" enctype="multipart/form-data">
                    <fieldset class="products">
                        <legend>Produits</legend>
                            <div class="container">
                            <div class="fields">
                                <div class="list">
                                    <select name="product[id]">
                                        <?php foreach ($products as $product) { ?>
                                            <option
                                                value="<?= $product->getId() ?>"
                                                <?= isset($selectedProduct) && $selectedProduct == $product->getId() ? "selected" : "" ?>
                                            >
                                                <?= $product->getName() ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="edit">
                                    <label for="product[name]"><h3><b>Nom</b></h3></label>
                                    <input type="text" name="product[name]">
                                    <label for="product[description]"><h3><b>Description</b></h3></label>
                                    <textarea name="product[description]" rows="5"></textarea>
                                    <div class="fieldgroups">
                                        <div class="fieldgroup">
                                            <label for="product_image"><h3><b>Image</b></h3></label>
                                            <div class="product-image-container">
                                                <button type="button" onclick="document.getElementById('product_img').click();">
                                                    <img src="img/products/unknown.jpg" alt="Product Image" id="product-image">
                                                </button>
                                                <input type="file" name="product_img" id="product_img" accept="image/png,image/jpeg">
                                            </div>
                                        </div>
                                        <div class="fieldgroup">
                                            <label for="product[price]"><h3><b>Prix (Rubis)</b></h3></label>
                                            <input type="number" min="0" name="product[price]">
                                            <label for="product[quantity]"><h3><b>Quantité</b></h3></label>
                                            <input type="number" min="0" name="product[quantity]">
                                            <label for="product[subcategory]"><h3><b>Sous-catégorie</b></h3></label>
                                            <select name="product[subcategory]">
                                                <?php foreach ($subcategories as $subcategory) { ?>
                                                    <option value="<?= $subcategory->getId() ?>"><?= $subcategory->getName() ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="actions">
                                <input type="submit" name="product[insert]" value="Nouveau">
                                <input type="submit" name="product[update]" value="Modifier">
                                <input type="submit" name="product[delete]" value="Supprimer" onclick="return confirm('Êtes-vous sur de vouloir supprimer ce produit ?')">
                            </div>
                        </div>
                    </fieldset>
                </form>
			</section>
        </main>

        <?php require("includes/footer.php") ?>

        <script>
            var categories = <?= json_encode($categories) ?>;
            var subcategories = <?= json_encode($subcategories) ?>;
            var products = <?= json_encode($products) ?>;
        </script>
        <script src="js/admin.js"></script>
    </body>
</html>

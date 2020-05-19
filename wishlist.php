<?php

require_once("includes/init.php");

if (!isset($_SESSION["user"])) {
	index();
}

if (isset($_POST["id"])) {
	if (isset($_POST["delete"])) {
		if ($wishlistItem = WishList::Get($_POST["id"])) {
			WishList::Delete($wishlistItem);
		}
	} else {
		if ($product = Product::Get($_POST["id"])) {
			$wishlistItem = new WishList();
			$wishlistItem->setUser($_SESSION["user"]);
			$wishlistItem->setProduct($product);
			WishList::Insert($wishlistItem);
		}
	}
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ma liste d'envies</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
			<h1>Ma liste d'envies</h1>
			<section class="wishlist">
				<?php foreach (WishList::Find(["id_user" => $_SESSION["user"]->getId()]) as $wishlist) { ?>
					<fieldset class="product-wishlist">
						<div>
							<a class="product" href="product.php?id=<?= $wishlist->getProduct()->getId() ?>">
								<h1><?= $wishlist->getProduct()->getName() ?></h1>
								<img src="img/<?= $wishlist->getProduct()->getImagePath() ?>" alt="<?= $wishlist->getProduct()->getName() ?>">
							</a>
						</div>
						<div>
							<p><?= $wishlist->getProduct()->getDescription() ?></p>
						</div>
						<form method="POST">
							<input type="hidden" name="id" value="<?= $wishlist->getId() ?>">
							<input class="button" type="submit" name="delete" value="Supprimer">
						</form>
					</fieldset>
				<?php } ?>
			</section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

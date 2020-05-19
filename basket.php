<?php

require_once("includes/init.php");

if (!isset($_SESSION["user"])) { index(); }

if (!isset($_SESSION["basket"])) {
	$_SESSION["basket"] = [];
}

if (!empty($_POST)) {
	if (isset($_POST["id"])) {
		if (isset($_POST["quantity"])) {
			$_SESSION["basket"][$_POST["id"]] = max(1, $_POST["quantity"]);
		} elseif (isset($_POST["delete"])) {
			unset($_SESSION["basket"][$_POST["id"]]);
		}
	}
}

$basket = [];
$total = 0;
$oneUnavailable = false;
foreach ($_SESSION["basket"] as $id => $quantity) {
	$product = Product::Get($id);
	$item = [
		"product" => $product,
		"quantity" => $quantity,
		"out_of_stock" => false,
		"limited_stock" => false,
		"unavailable" => false,
	];
	if ($product->getQuantity() <= 0) {
		$item["out_of_stock"] = true;
		$oneUnavailable = true;
	} elseif ($product->getQuantity() < $quantity) {
		$item["limited_stock"] = true;
		$oneUnavailable = true;
	}
	$basket[] = $item;
	$total += $product->getPrice() * $quantity;
}
$tooPoor = $total > $_SESSION["balance"];

if (!$tooPoor && !$oneUnavailable && isset($_POST["order"]) && isset($_POST["address"])) {
	$purchase = new Purchase();
	$purchase->setUser($_SESSION["user"]);
	$purchase->setAddress(Address::Get($_POST["address"]));
	$purchase->setPrice($total);
	$purchase->setMethod("rupees");
	Purchase::Insert($purchase);

	foreach ($basket as $item) {
		$productPurchase = new ProductPurchase();
		$productPurchase->setPurchase($purchase);
		$productPurchase->setProduct($item["product"]);
		$productPurchase->setQuantity($item["quantity"]);
		ProductPurchase::Insert($productPurchase);

		$item["product"]->setQuantity(max(0, $item["product"]->getQuantity() - $item["quantity"]));
		Product::Update($item["product"]);
	}

	$_SESSION["balance"] -= $total;
	$_SESSION["basket"] = [];
	header("Location: orders.php?purchase={$purchase->getId()}");
	die;
}

$addresses = Address::Find(["id_user" => $_SESSION["user"]->getId()]);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Panier</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/_basket.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
            <section class="basket">
	            <div class="basket-content">
					<h2>Votre panier</h2>
	                <div>
		                <?php
		                foreach ($basket as $item) {
							$product = $item["product"] ?>
							<div>
								<a class="product" href="product.php?id=<?= $product->getId() ?>">
									<img src="img/<?= $product->getImagePath() ?>">
									<h3><?= $product->getName() ?></h3>
									<p><?= $product->getDescription() ?></p>
									<p><?= number_format($product->getPrice() * $item["quantity"]) ?> Rubis</p>
								</a>
								<?php if ($item["out_of_stock"]) { ?>
									<p style="color: red;">Cet article est désormais en rupture de stock</p>
								<?php } elseif ($item["limited_stock"]) { ?>
									<p style="color: orange;">Il n'y a plus assez d'articles en stock par rapport à votre demande</p>
								<?php } else { ?>
									<form method="POST">
										<input type="hidden" name="id" value="<?= $product->getId() ?>">
										<label for="quantity">Quantité: </label>
										<input name="quantity" type="number" min="1" max="<?= $product->getQuantity() ?>" value="<?= $item["quantity"] ?>">
										<span> / <?= $product->getQuantity() ?></span>
										<input class="button" type="submit" value="Modifier">
									</form>
									<br>
								<?php } ?>
								<form method="POST">
									<input type="hidden" name="id" value="<?= $product->getId() ?>">
									<input type="submit" name="delete" value="❌">
								</form>
							</div>
						<?php } ?>
	                </div>
	            </div>
	            <div class="order-form">
	                <p class="balance-">Solde disponible: <?= number_format($_SESSION["balance"]) ?> Rubis</p>
	                <p class="basket-total">Total: <?= number_format($total) ?> Rubis</p>
					<form method="POST">
						<label for="address">Adresse:</label>
						<select name="address">
							<?php foreach ($addresses as $address) { ?>
								<option value="<?= $address->getId() ?>">
									<?= $address->getName() ?> - <?= $address->getAddress() ?>, <?= $address->getZipCode() ?>, <?= $address->getCity() ?>, <?= $address->getCountry() ?>
								</option>
							<?php } ?>
						</select><br>
						<?php if ($tooPoor) { ?>
							<p>Vous n'avez pas assez de solde pour cette commande</p>
						<?php } elseif ($oneUnavailable) { ?>
							<p>Un des articles de votre panier n'est pas disponible</p>
						<?php } else { ?>
							<br>
						<?php } ?>
						<input type="submit" name="order" value="Payer" <?= ($tooPoor || $oneUnavailable) ? "disabled" : "" ?>>
					</form>
	            </div>
	        </section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

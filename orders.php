<?php

require_once("includes/init.php");

if (!isset($_SESSION["user"])) {
	index();
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Commandes</title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	<?php require("includes/header.php") ?>

	<main>
		<h1>Mes commandes</h1>
		<section class="orders">
			<?php foreach (array_reverse(Purchase::Find(["id_user" => $_SESSION["user"]->getId()])) as $purchase) { ?>
				<fieldset class="order">
					<?php if ($purchase->getAddress() != null) { ?>
						<legend>Commande à l'adresse <?= $purchase->getAddress()->getName() ?></legend>
					<?php } else { ?>
						<legend>Commande à une adresse inconnue</legend>
					<?php }
					foreach (ProductPurchase::Find(["id_purchase" => $purchase->getId()]) as $productPurchase) { ?>
						<article class="product-purchase">
							<div>
								<a href="product.php?id=<?= $productPurchase->getProduct()->getId() ?>">
									<h1><?= $productPurchase->getProduct()->getName() ?></h1>
									<img src="img/<?= $productPurchase->getProduct()->getImagePath() ?>" alt="<?= $productPurchase->getProduct()->getName() ?>">
								</a>
							</div>
							<div>
								<p><?= $productPurchase->getProduct()->getDescription() ?></p>
								<p><b>Quantité</b>: <?= $productPurchase->getQuantity() ?></p>
							</div>
						</article>
					<?php } ?>
					<p><b>Total</b>: <?= number_format($purchase->getPrice()) ?> Rubis</p>
				</fieldset>
			<?php } ?>
		</section>
	</main>

	<?php require("includes/footer.php") ?>
</body>
</html>

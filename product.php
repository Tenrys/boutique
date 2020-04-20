<?php

require_once("includes/init.php");

if (!isset($_GET["id"])) {
	index();
}

$productId = $_GET["id"];

$product = Product::Get($productId);

if (!$product) {
	index();
}

if (isset($_SESSION["user"])) {
	if (isset($_POST["new"])) {
		$message = (string)($_POST["message"] ?? "");
		$rating = (int)($_POST["rating"] ?? "");

		$comment = new Comment();
		$comment->setProduct($product);
		$comment->setUser($_SESSION["user"]);
		$comment->setMessage($message);
		$comment->setRating($rating);

		Comment::Insert($comment);
	}

	if ($_SESSION["user"]->getRank() > 0) {
		if (isset($_POST["delete"])) {
			$commentId = (string)($_POST["id"] ?? "");

			$comment = Comment::Get($commentId);
			if ($comment) Comment::Delete($comment);
		}
	}
}

$comments = Comment::Find(["id_product" => $productId]);

?>

<html>
    <head>
        <title>Accueil</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
			<section class="product-left">
				<img src="img/<?= $product->getImagePath() ?>" alt="<?= $product->getName() ?>">
				<?php show_rating($product) ?>
				<form action="wishlist.php" method="POST">
					<input type="hidden" name="id" value="<?= $product->getId() ?>">
					<input type="submit" value="💖 Ajouter à ma liste d'envies">
				</form>
			</section>
			<section class="product-right">
				<p><?= $product->getDescription() ?></p>
				<?php if ($product->getQuantity() > 0) { ?>
					<form action="basket.php" method="POST">
						<label for="quantity">Quantité:</label>
						<input type="number" name="quantity" min="1" max="<?= $product->getQuantity() ?>" value="1"></section>
						<input type="submit" value="🛒 Ajouter au panier">
						<input type="hidden" name="id" value="<?= $product->getId() ?>">
					</form>
				<?php } else { ?>
					<p style="color: orange;">Rupture de stock</p>
				<?php } ?>
			</section>
			<section class="comments">
				<h1>Commentaires</h1>
				<?php foreach ($comments as $comment) { ?>
					<div class="comment">
						<p><?= $comment->getUser()->getFullName() ?></p>
						<?php show_rating($comment) ?>
						<p><?= $comment->getMessage() ?>
						<p><?= $comment->getDate()->format("\\L\\e Y-m-d à H:i:s") ?></p>
						<?php if (isset($_SESSION["user"]) && $_SESSION["user"]->getRank() > 0) { ?>
							<form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?')">
								<input type="hidden" name="id" value="<?= $comment->getId() ?>">
								<input type="submit" name="delete" value="Supprimer">
							</form>
						<?php } ?>
					</div>
				<?php } ?>
			</section>
			<?php if (isset($_SESSION["user"])) { ?>
				<section class="add-comment">
					<fieldset>
						<legend>Ajouter un commentaire</legend>
						<form method="POST" style="margin: 0;">
							<select name="rating" required>
								<option value="" disabled selected>Note</option>
								<option value="0">0 étoiles</option>
								<option value="1">1 étoile</option>
								<option value="2">2 étoiles</option>
								<option value="3">3 étoiles</option>
								<option value="4">4 étoiles</option>
								<option value="5">5 étoiles</option>
							</select>
							<textarea name="message" style="width: 100%; height: 100%;" minlength="3" required></textarea>
							<input type="submit" name="new" value="Envoyer">
						</form>
					</fieldset>
				</section>
			<?php } ?>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

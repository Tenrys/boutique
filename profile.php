<?php

require_once("includes/init.php");

if (!isset($_SESSION["user"])) {
	index();
}

$addresses = Address::Find(["id_user" => $_SESSION["user"]->getId()]);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mon profil</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
            <h1>Mon profil</h1>
            <section class="profile-info">
				<h3><b>Nom</b></h3>
				<p><?= $_SESSION["user"]->getLastName() ?></p>
				<h3><b>Prénom</b></h3>
				<p><?= $_SESSION["user"]->getFirstName() ?></p>
				<h3><b>E-mail</b></h3>
				<p><?= $_SESSION["user"]->getEmail() ?></p>
				<h3><b>Rang</b></h3>
				<p><?= $ranks[$_SESSION["user"]->getRank()] ?? "???" ?></p>
				<h3><b>Date de naissance</b></h3>
				<p><?= strftime("%d/%m/%G", $_SESSION["user"]->getBirthday()->getTimestamp()) ?></p>
			</section>
			<section class="addresses">
				<h3><b>Adresses</b></h3>
				<?php foreach ($addresses as $address) { ?>
					<fieldset class="address">
						<legend><b><?= $address->getName() ?></b></legend>
						<h3><b>Adresse</b></h3>
						<p><?= $address->getAddress() ?></p>
						<h3><b>Code postal</b></h3>
						<p><?= $address->getZipCode() ?></p>
						<h3><b>Ville</b></h3>
						<p><?= $address->getCity() ?></p>
						<h3><b>Pays</b></h3>
						<p><?= $address->getCountry() ?></p>
					</fieldset>
				<?php } ?>
			</section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

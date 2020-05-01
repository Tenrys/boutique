<?php

require_once("includes/init.php");

if (!isset($_SESSION["user"])) {
	index();
}

if (isset($_POST["update"])) {
    [$success, $message, $user] = User::Register($_POST, $_SESSION["user"]);

    if ($success) {
        header("Location: profile.php");
        die;
    }
} elseif (isset($_POST["address_id"])) {
	if ($address = Address::Get(["id" => $_POST["address_id"], "id_user" => $_SESSION["user"]->getId()])) {
		if (isset($_POST["update_address"])) {
			$address->setName($_POST["name"]);
			$address->setAddress($_POST["address"]);
			$address->setZipCode($_POST["zip_code"]);
			$address->setCity($_POST["city"]);
			$address->setCountry($_POST["country"]);
			Address::Update($address);
		} elseif (isset($_POST["delete_address"])) {
			Address::Delete($address);
		}
	}
} elseif (isset($_POST["add_address"])) {
	$address = new Address();
	$address->setUser($_SESSION["user"]);
	$address->setName("Nouvelle adresse");
	Address::Insert($address);
}

$addresses = Address::Find(["id_user" => $_SESSION["user"]->getId()]);

var_dump($_SESSION["user"]);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modifier mon profil</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
            <section class="edit-profile">
                <h3><b>Modifier mon profil</b></h3>
                <?php if (isset($success) && !$success) { ?>
	                <p class="alert"><?= $message ?></p>
	            <?php } ?>
                <fieldset class="profile-info">
	                <form method="POST">
						<label for="lastname"><h3><b>Nom</b></h3></label>
						<input type="text" minlength="3" maxlength="255" name="lastname" required value="<?= $_SESSION["user"]->getLastName() ?>">
						<br>
						<label for="firstname"><h3><b>Prénom</b></h3></label>
						<input type="text" minlength="3" maxlength="255" name="firstname" required value="<?= $_SESSION["user"]->getFirstName() ?>">
						<br>
						<label for="email"><h3><b>E-mail</b></h3></label>
						<input type="email" minlength="3" maxlength="255" name="email" required value="<?= $_SESSION["user"]->getEmail() ?>">
						<br>
						<label for="password"><h3><b>Mot de passe</b></h3></label>
	                    <input type="password" name="password" value="<?= $_POST["password"] ?? "" ?>"><br>
	                    <br>
	                    <label for="passwordConfirm"><h3><b>Confirmez votre mot de passe</b></h3></label>
	                    <input type="password" name="passwordConfirm" value="<?= $_POST["passwordConfirm"] ?? "" ?>">
	                    <br>
						<label for="birthday"><h3><b>Date de naissance</b></h3></label>
						<input type="date" name="birthday" value="<?= strftime("%G-%m-%d", $_SESSION["user"]->getBirthday()->getTimestamp()) ?>">
						<br>
						<input class="button-form" type="submit" name="update" value="Modifier">
					</form>
				</fieldset>
			</section>
			<section class="addresses">
				<h3><b>Adresses</b></h3>
				<?php foreach ($addresses as $address) { ?>
					<fieldset class="address">
						<legend><b><?= $address->getName() ?></b></legend>
						<form method="post">
							<input type="hidden" name="address_id" value="<?= $address->getId() ?>">
							<label for="name"><h3><b>Nom</b></h3></label>
							<input type="text" name="name" minlength="3" maxlength="255" value="<?= $address->getName() ?>">
							<br>
							<label for="address"><h3><b>Adresse</b></h3></label>
							<input type="text" name="address" minlength="3" maxlength="500" value="<?= $address->getAddress() ?>">
							<br>
							<label for="zip_code"><h3><b>Code postal</b></h3></label>
							<input type="number" name="zip_code" value="<?= $address->getZipCode() ?>">
							<br>
							<label for="city"><h3><b>Ville</b></h3></label>
							<input type="text" name="city" minlength="3" maxlength="140" value="<?= $address->getCity() ?>">
							<br>
							<label for="country"><h3><b>Pays</b></h3></label>
							<input type="text" name="country" minlength="3" maxlength="140" value="<?= $address->getCountry() ?>"><br>
							<br>
							<input type="submit" name="update_address" value="Modifier">
							<input type="submit" name="delete_address" value="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette adresse ?')">
						</form>
					</fieldset>
					<br>
					<form method="POST">
						<input type="submit" name="add_address" value="Ajouter une adresse">
					</form>
				<?php } ?>
			</section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>

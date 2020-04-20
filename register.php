<?php

require_once("includes/init.php");

if (isset($_SESSION["user"])) { index(); }

if (isset($_POST["register"])) {
    [$success, $message, $user] = User::Register($_POST);

    if ($success) {
        header("Refresh: 5; URL=login.php");
    }
}

?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <?php require("includes/header.php") ?>

        <main>
            <h1 class="title-medium">Inscription</h1>

            <?php if (isset($success) && $success) { ?>
                <p>Inscription réussie !<p>
                <p>Vous allez être redirigé vers la page de connexion...</p>
            <?php } else {
                if (isset($message)) { ?>
                    <p class="alert"><?= $message ?></p>
                <?php } ?>
                <form class="formu" method="post">
                    <label class="label" for="lastname">Nom</label>
                    <input class="input" type="text" name="lastname" required value="<?= $_POST['lastname'] ?? '' ?>">
                    <br>
                    <label class="label" for="firstname">Prénom</label>
                    <input class="input" type="text" name="firstname" required value="<?= $_POST['firstname'] ?? '' ?>">
                    <br>
                    <label class="label" for="mail">E-mail</label>
                    <input class="input" type="email" name="email" required value="<?= $_POST['email'] ?? '' ?>">
                    <br>
                    <label class="label" for="birthday">Anniversaire</label>
                    <input class="input" type="date" name="birthday" required value="<?= $_POST['birthday'] ?? '' ?>">
                    <br>
                    <label class="label" for="password">Mot de passe</label>
                    <input class="input" type="password" name="password" required value="<?= $_POST['password'] ?? '' ?>"><br>
                    <br>
                    <label class="label" for="passwordConfirm">Confirmez votre mot de passe</label>
                    <input class="input" type="password" name="passwordConfirm" required value="<?= $_POST['passwordConfirm'] ?? '' ?>"><br>
                    <br>
                    <input class="button-form" type="submit" name="register" value="S'inscrire">
                </form>
            <?php } ?>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>
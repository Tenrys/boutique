<?php

require_once("includes/init.php");

if (isset($_SESSION["user"])) { index(); }

if (isset($_POST["login"])) {
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    [$success, $message, $user] = User::Login($email, $password);

    if ($success && $user instanceof User) {
        $_SESSION["user"] = $user;
        $_SESSION["balance"] = 10000;

        index();
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Connexion</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php require("includes/header.php") ?>

        <main>
            <h1 class="title-medium">Connexion</h1>

            <section class="section">
                <?php if (isset($message)) { ?>
                    <p class="alert"><?= $message ?></p>
                <?php } ?>
                <form class="form" method="post">
                    <label class="label" for="email">E-mail</label>
                    <input class="input" type="email" name="email" required>
                    <br>
                    <label class="label" for="password">Mot de passe</label>
                    <input class="input" type="password" name="password" required>
                    <br>
                    <input class="button-form" type="submit" name="login" value="Se connecter">
                </form>
            </section>
            <section class="section">
                <div class="profile-option">
                    <p>
                        Vous n'avez pas de compte ? Inscrivez-vous <a href="inscription.php">ici</a> !
                    </p>
                </div>
            </section>
        </main>

        <?php require("includes/footer.php") ?>
    </body>
</html>
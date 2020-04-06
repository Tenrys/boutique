<?php

define('PHP_ROOT', __DIR__);
define('HTTP_ROOT', 'localhost' == $_SERVER['HTTP_HOST'] ? '/boutique/' : '/');


?>
<header>
    <div id="banner"><h1>La boutique de Zelda</h1>
    <?php if($_SESSION['user']->isConnected() != false)
    {
    ?>
    <form action="<?= HTTP_ROOT ?>index.php" method="post" class="deconnexion">
	               <input name="deconnexion" value="Se déconnecter" type="submit" />
            </form>
				
		<?php
		if (isset($_POST["deconnexion"]))
            {
                session_unset();
                session_destroy();
                header('Location:index.php');
            }
        }
        else{
            ?>
            <a id="button" href="<?= HTTP_ROOT ?>connexion.php">Se connecter</a><br>
            <a id="button" href="<?= HTTP_ROOT ?>inscription.php">S'inscrire</a>
            <?php
        }?>

    <div id="menu"><?php require 'nav.php'?></div></div>
</header>
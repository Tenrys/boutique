<?php

define('PHP_ROOT', __DIR__);
define('HTTP_ROOT', 'localhost' == $_SERVER['HTTP_HOST'] ? '/boutique/' : '/');


?>
<header>
    <section id="banner"><h1 class="title">La boutique de Terry</h1>
    <div id="connexion">
    <?php if($_SESSION['user']->isConnected() != false)
    {
    ?>
    <form action="<?= HTTP_ROOT ?>index.php" method="post" class="deconnexion">
	               <input class="button" name="deconnexion" value="Se déconnecter" type="submit" />
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
            <a class="button" href="<?= HTTP_ROOT ?>connexion.php">Se connecter</a>
            <a class="button" href="<?= HTTP_ROOT ?>inscription.php">S'inscrire</a>
            <?php
        }?>
        </div>  
    </section>
  

    <div id="header"><?php require 'nav.php'?></div>
</header>
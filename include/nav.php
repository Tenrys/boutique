<?php 
$connexion = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
?>
<nav>
<ul id="menu">
                <li class="violet"><a href="<?= HTTP_ROOT ?>index.php">Accueil</a></li>
                <?php 
                if($_SESSION['user']->isConnected() != false)
                {
                    ?>
                <li class="violet"><a href="<?= HTTP_ROOT ?>profil.php">Mon compte</a></li>
                    <ul>
                        <li class="violet"><a href="<?= HTTP_ROOT ?>profil-client.php">Modifier mon compte</a></li>
                        <li class="violet"><a href="<?= HTTP_ROOT ?>purchase.php">Mes commandes</a></li>
                        <li class="violet"><a href="<?= HTTP_ROOT ?>wishlist.php">Ma liste d'envie</a></li>
                        <li class="violet"><a href="<?= HTTP_ROOT ?>adress.php">Mon carnet d'adresse</a></li>
                <?php
                    if($_SESSION['user']->getGrade() == "admin")
                    {
                        ?>
                        <li class="violet"><a href="<?= HTTP_ROOT ?>admin.php">Gérer le site</a></li>
                        <?php
                    }
                    ?>
                    </ul>
                    <?php
                }
                ?>

                <li class="violet"><a href="<?= HTTP_ROOT ?>produits.php">Produits</a></li>
                <?php

                    $request = "SELECT name, id FROM category";
                    foreach($connexion->query($request) as $result)
                    {
                        ?>
                        <ul>
                            <li><a href="<?= HTTP_ROOT ?>category.php?=<?php echo $result['id']?>"><?php echo $result['name']?></a></li>
                            <?php
                                $requete = "SELECT name, id, id_category FROM sub_category WHERE id_category = \"$result[id]\"";
                                foreach($connexion->query($requete) as $resultat)
                                {
                                    ?>
                                    <ul>
                                        <li><a href="<?= HTTP_ROOT ?>subcategory.php?=<?php echo $resultat['id']?>"><?php echo $resultat['name']?></a></li>
                                </ul>
                                <?php
                                }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                    </ul>
</nav>
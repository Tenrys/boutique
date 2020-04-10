<?php 
$connexion = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
?>
<nav>
    <div id="nav">
<ul id="menu">
                <li class="nav"><a class="title-header" href="<?= HTTP_ROOT ?>index.php">Accueil</a></li>
                <?php 
                if($_SESSION['user']->isConnected() != false)
                {
                    ?>
                <li class="nav"><a class="title-header" href="<?= HTTP_ROOT ?>profil.php">Mon compte</a>
                    <ul class="cat">
                        <li class="sub"><a class="name-header" href="<?= HTTP_ROOT ?>profil-client.php">Modifier mon compte</a></li>
                        <li class="sub"><a class="name-header" href="<?= HTTP_ROOT ?>purchase.php">Mes commandes</a></li>
                        <li class="sub"><a class="name-header" href="<?= HTTP_ROOT ?>wishlist.php">Ma liste d'envie</a></li>
                        <li class="sub"><a class="name-header" href="<?= HTTP_ROOT ?>adress.php">Mon carnet d'adresse</a></li>
                <?php
                    if($_SESSION['user']->getGrade() == "admin")
                    {
                        ?>
                        <li class="sub"><a class="name-header" href="<?= HTTP_ROOT ?>admin.php">Gérer le site</a></li>
                        <?php
                    }
                    ?>
                    </ul>
                    </li>
                    <?php
                }
                ?>

                <li class="nav"><a class="title-header" href="<?= HTTP_ROOT ?>produits.php">Produits</a>
                <ul class="cat">
                <?php

                    $request = "SELECT name, id FROM category";
                    foreach($connexion->query($request) as $result)
                    {
                        ?>
                            <li class="sub"><a class="name-header" href="<?= HTTP_ROOT ?>category.php?=<?php echo $result['id']?>"><?php echo $result['name']?></a><ul class="sous-cat">
                            <?php
                                $requete = "SELECT name, id, id_category FROM sub_category WHERE id_category = \"$result[id]\"";
                                foreach($connexion->query($requete) as $resultat)
                                {
                                    ?>
                                    
                                        <li class="nav-sub"><a class="name-header" href="<?= HTTP_ROOT ?>subcategory.php?=<?php echo $resultat['id']?>"><?php echo $resultat['name']?></a></li>
                                
                                <?php
                                }
                                
                            ?>
                            </ul>
                            </li>
                        
                        <?php
                    }
                    ?>
                    </ul>
                    </li>
                    </ul>
    </div>
</nav>
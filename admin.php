<html>

<?php

require 'class/bdd.php';
require 'class/user.php';
require 'class/adm.php';

session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}

if($_SESSION['user']->getGrade() != "admin")
{
    header('Location:index.php');
}

?>

<head>
        <title>Panel de contrôle</title> 
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8_decode">
</head>



<body>

    <?php require 'include/header.php'?>

<main>
    <section>
        <h1 class="title_medium">Catégories</h1>
            <?php
                include 'cat-adm.php';
            ?>
    </section>
    <section>
        <h1 class="title_medium">Sous-Catégories</h1>
            <?php
                include 'sub-cat-adm.php';
            ?>
    </section>
    <section>
        <h1 class="title_medium">Produits</h1>
            <?php
                include 'product-adm.php';
            ?>
    </section>
</main>

    <?php require 'include/footer.php'?>

</body>

</html>
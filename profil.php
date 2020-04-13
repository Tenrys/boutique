<html>

<?php

require 'class/bdd.php';
require 'class/user.php';

session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}

?>

<head>
        <title>Mon compte</title> 
        <link rel="stylesheet" href="css/style.css">
</head>



<body>

    <?php require 'include/header.php'?>

<main>

<?php 

$birthday = false;

$name = $_SESSION["user"]->getName();

$today = date('Y-m-d');

if(($_SESSION["user"]->getBirthday()) == $today)
{
    $birthday = true;
}

$point = $_SESSION["user"]->getPoints();

?>

<div class="profil">
<span>Bonjour <?php echo $name[0] ?><br>
        Vous avez actuellement <?php echo $point ?> points</span>
        <?php
        if($birthday == true)
        {
            ?>
            <span>Joyeux anniversaire !</span>
            <?php
        }


        ?>
</div>
<div class="profil_option">
    <a href="purchase.php">Vos dernières commandes</a>
</div>
<div class="profil_option">
    <a href="adress.php">Votre carnet d'adresse</a>
</div>
<div class="profil_option">
    <a href="wishlist.php">Votre liste d'envie</a>
</div>
<div class="profil_option">
    <a href="profil-client.php">Modifier vos informations</a>
</div>
<?php
if($_SESSION['user']->getGrade() == "admin")
{
    ?>
    <div class="profil_option">
        <a href="admin.php">Accèder au panneau de contrôle</a>
    </div>
    <?php
}
?>




</main>

    <?php require 'include/footer.php'?>

</body>

</html>
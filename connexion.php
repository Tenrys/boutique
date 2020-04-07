<?php

require 'class/bdd.php';
require 'class/user.php';
require 'class/adm.php';

session_start();

if(!isset($_SESSION['bdd']))
{
    $_SESSION['bdd'] = new bdd();
}
if(!isset($_SESSION['user'])){
    $_SESSION['user'] = new user();
}

if($_SESSION['user']->isConnected() != false){
   header('Location:index.php');
}

?>

<head>
<meta charset="utf-8" />
        <title>Connexion</title> 
        <link rel="stylesheet" href="css/style.css">
</head>

<body>

<main>
<?php require 'include/header.php'?>
<h1> Connexion </h1>


   <section class="section">
        <form class="formulaire" action="<?= HTTP_ROOT ?>connexion.php" method="post">
        
            <label for="email">Email</label>
            <input type="email" name="email" required><br>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required><br>

            <input type="submit" name="submit" value="Connectez-vous">
        </form>
   </section>
<?php
if(isset($_POST["submit"])){
    if($_SESSION['user']->login($_POST['email'],$_POST['password']) == "ok")
    {
        $_SESSION['mail'] = true;
       if($_SESSION['user']->getGrade() == "admin");
       {
           $_SESSION['admin'] = new admin;
       }
       ?>
        <meta http-equiv="refresh" content="0;URL=index.php">
       <?php
    }
    else if($_SESSION['user']->login($_POST['email'],$_POST['password']) == "mdp")
    {
        ?>
            <p>Votre mot de passe est incorrect</p>
        <?php
    }
    else if($_SESSION['user']->login($_POST['email'],$_POST['password']) == "mail")
    {
        ?>
        <p>Aucun utilisateur trouvé avec cet email</p>
        <?php
    }
    
}
?>
<section class="section">
    <div class="bloc">
        <span>
            Vous n'avez pas de compte ? Inscrivez vous <a href="<?= HTTP_ROOT ?>inscription.php">ici</a>
        </span>
    </div>
</section>




<?php require 'include/footer.php'?>
</main>


</body>

</html>
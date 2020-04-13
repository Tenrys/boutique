<?php

require 'class/bdd.php';
require 'class/user.php';

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
        <title>Inscription</title> 
        <link rel="stylesheet" href="css/style.css">
</head>

<body>


<?php require 'include/header.php'?>
<main>
<h1 class="title_medium"> Inscription </h1>


   
        <form class="form" action="inscription.php" method="post">
        
            <label class="label" for="lastname">Nom</label>
            <input class="input" type="text" name="lastname" required><br>
            <label class="label" for="firstname">Prénom</label>
            <input class="input" type="text" name="firstname" required><br>
            <label class="label" for="mail">Email</label>
            <input class="input" type="email" name="mail" required><br>
            <label class="label" for="birthday">Anniversaire</label>
            <input class="input" type="date" name="birthday" required></br>
            <label class="label" for="parrain">Email de votre parrain</label>
            <input class="input" type="email" name="parrain" ></br>
            <label class="label" for="password">Mot de passe</label>
            <input class="input" type="password" name="password" required><br>
            <label class="label" for="cpassword">Confirmez votre mot de passe</label>
            <input class="input" type="password" name="cpassword" required><br>

            <input class="button_form" type="submit" name="submit" value="S'inscrire">
        </form>

        <?php
            if(isset($_POST['submit']))
            {
                $point = 0;
                if($_POST["parrain"] != NULL)
                {
                    $parrain = $_POST["parrain"];
                    $connexion = new PDO('mysql:host=localhost;dbname=boutique', 'root', '');
                    $request = $connexion->prepare("SELECT id FROM user WHERE mail = '$parrain'");
                    $request->execute();
                    $check = $request->rowCount();
                    if($check == 1)
                    {
                        $point = 300;
                    }
                    else
                    {
                        echo "Votre parrain n'existe pas";
                    }
                }
                else
                {
                    $point = 100;
                }
                if($point >= 100)
                {
                    if($_SESSION["user"]->register($_POST['lastname'],$_POST["firstname"],$_POST['mail'],$_POST['birthday'], $point, $_POST['password'], $_POST['cpassword'], "membre") == "all good"){
                        
                        ?>
                        <span>Vous allez être redirigé vers la page de connexion</span>
                        <meta http-equiv="refresh" content="5;URL=connexion.php">
                        <?php
                    }
                    elseif($_SESSION["user"]->register($_POST['lastname'],$_POST["firstname"],$_POST['mail'],$_POST['birthday'], $point, $_POST['password'], $_POST['cpassword'], "membre") == "email"){
                        ?>
                            <p>Cet email est déjà utilisé</p>
                        <?php
                    }
                    elseif($_SESSION["user"]->register($_POST['lastname'],$_POST["firstname"],$_POST['mail'],$_POST['birthday'], $point, $_POST['password'], $_POST['cpassword'], "membre") == "empty"){
                        ?>
                            <p>Veuillez remplir tous les champs.</p>
                        <?php
                    }
                    elseif($_SESSION["user"]->register($_POST['lastname'],$_POST["firstname"],$_POST['mail'],$_POST['birthday'], $point, $_POST['password'], $_POST['cpassword'], "membre") == "mdp"){
                        ?>
                            <p>Les mots de passes ne sont pas identiques.</p>
                        <?php
                    }
                }
                
            }
        ?>


<?php require 'include/footer.php'?>
</main>


</body>

</html>
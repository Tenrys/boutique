<html>

<?php

require 'class/bdd.php';
require 'class/user.php';
require 'class/adress-class.php';

session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
if(!isset($_SESSION['adress']))
{
    $_SESSION['adress'] = new adress;
}

$id_user = $_SESSION['user']->getId();

?>

<head>
        <title>Carnet d'adresses</title> 
        <link rel="stylesheet" href="css/style.css">
</head>



<body>

    <?php require 'include/header.php'?>

<main>

<div>
    <h1 class="title_medium">Votre carnet d'adresses</h1>
    <?php
        $all_adresses = $_SESSION['adress']->getAllAdresses($id_user);

        ?>

            <form action="" method="post">
            <label class="label" for="adress-select">Choisissez une adresse à modifier:</label>

                <select class="select" name="name-adresses">
                    <?php
                foreach($all_adresses as $option)
                {
                    ?>
                    <option value="<?php echo $option['id']?>"><?php echo $option[5];?></option>
                    <?php
                }
                    ?>
                    <option value="add">Ajouter une adresse</option>
            
                </select>
                <input class="button_form" type="submit" name="choose">
            </form>        
        <?php
                if(isset($_POST['choose']) && $_POST['name-adresses'] != "add")
                {
                    $i = $_POST['name-adresses'];

                    $id_adress = $i;

                    $one_adress = $_SESSION['adress']->getOneAdress($i);

                    foreach($one_adress as $options)
                    {
                        ?>
                            
                            <form action="" method="post">
                            <label class="label" for="name_adress">Nom de votre adresse</label></br>
                            <input class="input" type="text" name="name_adress" value="<?php echo $options['name_adresse']?>" required></br>
                            <label class="label" for="adress">Numéro et nom de rue</label></br>
                            <input class="input" type="text" name="adress" value="<?php echo $options['adresse']?>" required></br>
                            <label class="label" for="zip_code">Code postal</label></br>
                            <input class="input" type="number" name="zip_code" value="<?php echo $options['zip_code']?>" max="99999" required></br>
                            <label class="label" for="city">Ville</label></br>
                            <input class="input" type="text" name="city" value="<?php echo $options['city']?>" required></br>
                            <label class="label" for="country">Pays</label></br>
                            <input class="input" type="text" name="country" value="<?php echo $options['country']?>" required></br>
                            <input class="button_form" type="submit" name="update" value="Modifier cette adresse">
                            <input class="button_form" type="submit" name="delete" value="Supprimer cette adresse">
                            </form>
                        <?php
                    }

                }
                else if(isset($_POST['choose']) && $_POST['name-adresses'] == "add")
                {
                    ?>
                    <secion>
                        <h1 class="title_medium">Ajouter une nouvelle adresse</h1>
                        <form action="" method="post">
                        <label class="label" for="name_adress">Nom de votre adresse</label></br>
                        <input class="input" type="text" name="name_adress" required></br>
                        <label class="label" for="adress">Numéro et nom de rue</label></br>
                        <input class="input" type="text" name="adress" required></br>
                        <label class="label" for="zip_code">Code postal</label></br>
                        <input class="input" type="number" name="zip_code" max="99999" required></br>
                        <label class="label" for="city">Ville</label></br>
                        <input class="input" type="text" name="city" required></br>
                        <label class="label" for="country">Pays</label></br>
                        <input class="input" type="text" name="country" required></br>
                        <input class="button_form" type="submit" name="create" value="Ajouter une adresse">
                        </form>
                    </secion>
                    <?php
                }
                if(isset($_POST['update']))
                {
                    $name_adresse = $_POST['name_adress'];
                    $adress = $_POST['adress'];
                    $zip_code = $_POST['zip_code'];
                    $city = $_POST['city'];
                    $country = $_POST['country'];
                    $id = $_SESSION['adress']->getIdAdress();
                    if($_SESSION['adress']->updateAdress($id, $adress, $zip_code, $city, $country,$name_adresse) == "good")
                    {
                    ?>
                    <span class="alert">Votre adresse a été modifiée avec succès</span>
                    <?php
                    }
                    else
                    {
                        ?>
                        <span class="alert">Une erreur est survenue</span>
                        <?php
                    }
                    
                }
                if(isset($_POST['delete']))
                {
                    $id = $_SESSION['adress']->getIdAdress();
                    $_SESSION['adress']->deleteAdress($id);
                    ?>
                    <span class="alert">Votre adresse à bien été supprimée</span>
                    <?php
                }
                if(isset($_POST['create']))
                {
                    $name_adress = $_POST['name_adress'];
                    $adress = $_POST['adress'];
                    $zip_code = $_POST['zip_code'];
                    $city = $_POST['city'];
                    $country = $_POST['country'];
                    if($_SESSION['adress']->createAdress($adress, $zip_code, $city, $country, $name_adress, $id_user) == "all good")
                    {
                        ?>
                        <span class="alert">Votre adresse à été ajoutée</span>
                        <meta http-equiv="refresh" content="0;URL=adress.php">
                        <?php
                    }
                    else if($_SESSION['adress']->createAdress($adress, $zip_code, $city, $country, $name_adress, $id_user) == "missing")
                    {
                        ?>
                        <span class="alert">Veuillez remplir tous les champs</span>
                        <?php
                    }
                    else if($_SESSION['adress']->createAdress($adress, $zip_code, $city, $country, $name_adress, $id_user) == "name")
                    {
                        ?>
                        <span class="alert">Vous ne pouvez pas avoir deux adresses sous le même nom</span>
                        <?php
                    }


                }


        
    ?>
</div>


</main>

    <?php require 'include/footer.php'?>

</body>

</html>
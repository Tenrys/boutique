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
    <h1>Votre carnet d'adresses</h1>
    <?php
        $all_adresses = $_SESSION['adress']->getAllAdresses($id_user);

        ?>

            <form action="" method="post">
            <label for="adress-select">Choisissez une adresse à modifier:</label>

                <select name="name-adresses">
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
                <input type="submit" name="choose">
            </form>        
        <?php
                if(isset($_POST['choose']) && $_POST['name-adresses'] != "add")
                {
                    $i = $_POST['name-adresses'];

                    $one_adress = $_SESSION['adress']->getOneAdress($i);

                    foreach($one_adress as $options)
                    {
                        ?>
                            
                            <form action="" method="post">
                            <label for="name_adress">Nom de votre adresse</label></br>
                            <input type="text" name="name_adress" value="<?php echo $options['name_adresse']?>" required></br>
                            <label for="adress">Numéro et nom de rue</label></br>
                            <input type="text" name="adress" value="<?php echo $options['adresse']?>" required></br>
                            <label for="zip_code">Code postal</label></br>
                            <input type="number" name="zip_code" value="<?php echo $options['zip_code']?>" max="5" required></br>
                            <label for="city">Ville</label></br>
                            <input type="text" name="city" value="<?php echo $options['city']?>" required></br>
                            <label for="country">Pays</label></br>
                            <input type="text" name="country" value="<?php echo $options['country']?>" required></br>
                            <input type="submit" name="update" value="Modifier cette adresse">
                            <input type="submit" name="delete" value="Supprimer cette adresse">
                            </form>
                        <?php
                    }

                }
                else if(isset($_POST['choose']) && $_POST['name-adresses'] == "add")
                {
                    ?>
                    <secion>
                        <h1>Ajouter une nouvelle adresse</h1>
                        <form action="" method="post">
                        <label for="name_adress">Nom de votre adresse</label></br>
                        <input type="text" name="name_adress" required></br>
                        <label for="adress">Numéro et nom de rue</label></br>
                        <input type="text" name="adress" required></br>
                        <label for="zip_code">Code postal</label></br>
                        <input type="number" name="zip_code" max="5" required></br>
                        <label for="city">Ville</label></br>
                        <input type="text" name="city" required></br>
                        <label for="country">Pays</label></br>
                        <input type="text" name="country" required></br>
                        <input type="submit" name="create" value="Ajouter une adresse">
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
                    $id = $option['id'] ;
                    $_SESSION['adress']->updateAdress($id, $adress, $zip_code, $city, $country,$name_adresse);
                    ?>
                    <span>Votre adresse a été modifiée avec succès</span>
                    <?php
                    
                }
                if(isset($_POST['delete']))
                {
                    $id = $option['id'];
                    $_SESSION['adress']->deleteAdress($id);
                    ?>
                    <span>Votre adresse à bien été supprimée</span>
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
                        <span>Votre adresse à été ajoutée</span>
                        <meta http-equiv="refresh" content="0;URL=adress.php">
                        <?php
                    }
                    else if($_SESSION['adress']->createAdress($adress, $zip_code, $city, $country, $name_adress, $id_user) == "missing")
                    {
                        ?>
                        <span>Veuillez remplir tous les champs</span>
                        <?php
                    }
                    else if($_SESSION['adress']->createAdress($adress, $zip_code, $city, $country, $name_adress, $id_user) == "name")
                    {
                        ?>
                        <span>Vous ne pouvez pas avoir deux adresses sous le même nom</span>
                        <?php
                    }


                }


        
    ?>
</div>


</main>

    <?php require 'include/footer.php'?>

</body>

</html>
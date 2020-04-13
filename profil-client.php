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
        <title>Modifier mon compte</title> 
        <link rel="stylesheet" href="css/style.css">
</head>



<body>

    <?php require 'include/header.php'?>

<main>

<?php

$name = $_SESSION['user']->getName();
$birthday = $_SESSION['user']->getBirthday();
$mail = $_SESSION['user']->getMail();
$id = $_SESSION['user']->getId();


?>
<section class="bloc">
    <h1 class="title_medium">Modifier vos informations personnelles</h1>
<form method="post" action="profil-client.php" class="form">

            <label class="label" for="lastname">Nom</label>
            <input class="input" type="text" name="lastname" value="<?php echo $name[0]?>"><br>
            <label class="label" for="firstname">Prénom</label>
            <input class="input" type="text" name="firstname" value="<?php echo $name[1]?>"><br>
            <label class="label" for="mail">Email</label>
            <input class="input" type="email" name="mail" value="<?php echo $mail?>"><br>
            <label class="label" for="birthday">Anniversaire</label>
            <input class="input" type="date" name="birthday" value="<?php echo $birthday?>"></br>
            <label class="label" for="password">Mot de passe actuel</label>
            <input class="input" type="password" name="password" required><br>
            <input class="button_form" type="submit" name="update" value="Modifier">

</form>
</section>
<?php
if(isset($_POST['update']))
{
    if($_POST['password'] != NULL)
    {
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $mail = $_POST['mail'];
        $birthday = $_POST['birthday'];
        $password = $_POST['password'];
        if($_SESSION['user']->update($id, $lastname, $firstname, $mail, $birthday, $password) == "good")
        {
           ?>
           <span class="alert">Vos données ont étées mises à jour</span>
           <?php
        }
        else if ($_SESSION['user']->update($id, $lastname, $firstname, $mail, $birthday, $password) == "mail")
        {
            ?>
            <span class="alert">Cet email est déjà utilisé</span>
            <?php
        }
    }
    else
    {
        ?>
        <span class="alert">Veuillez renseigner votre mot de passe</span>
        <?php
    }
}

?>
<section class="bloc">
<h1 class="title_medium">Modifier votre mot de passe</h1>
<form method="post" action="profil-client.php" class="form">
    <label class="label" for="oldpassword">Votre mot de passe actuel</label>
    <input class="input" type="password" name="oldpassword"></br>
    <label class="label" for="newpassword">Votre nouveau mot de passe</label>
    <input class="input" type="password" name="newpassword"></br>
    <label class="label" for="cnewpassword">Confirmez votre nouveau mot de passe</label>
    <input class="input" type="password" name="cnewpassword"></br>
    <input class="button_form" type="submit" name="updatepassword" value="Modifier">

</form>
</section>
<?php
if(isset($_POST['updatepassword']))
{
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $cnewpassword = $_POST['cnewpassword'];

    if($_SESSION['user']->updatePassword($id, $oldpassword, $newpassword, $cnewpassword) == "very good")
    {
        ?>
        <span class="alert">Votre mot de passe a été modifié</span>
        <?php
    }
    else if($_SESSION['user']->updatePassword($id, $oldpassword, $newpassword, $cnewpassword) == "oldmdp")
    {
        ?>
        <span class="alert">Votre mot de passe actuel est incorrect</span>
        <?php
    }
    else if($_SESSION['user']->updatePassword($id, $oldpassword, $newpassword, $cnewpassword) == "match")
    {
        ?>
        <span class="alert">Votre nouveau mot de passe et votre confirmation de mot de passe sont différents</span>
        <?php
    }
    else if($_SESSION['user']->updatePassword($id, $oldpassword, $newpassword, $cnewpassword) == "missing")
    {
        ?>
        <span class="alert">Veuillez renseigner les informations demandées</span>
        <?php
    }
}

?>
<section class="bloc">
    <h1 class="title_medium">Supprimer votre compte</h1>
    <span class="alert">Attention, cette action est irréversible</span>
    <form class="form" method="post">
    <input class="button_form" type="submit" name="delete" value="Supprimer">
    </form>
</section>
<?php
    if(isset($_POST['delete']))
    {
       $_SESSION['user']->delete();
       $_SESSION['user']->disconnect();
        session_unset();
        session_destroy();
        ?>
        <meta http-equiv="refresh" content="0;URL=index.php">
    <?php
    }
?>
</main>

    <?php require 'include/footer.php'?>

</body>

</html>
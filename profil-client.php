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
<section>
    <h1>Modifier vos informations personnelles</h1>
<form method="post" action="profil-client.php">

            <label for="lastname">Nom</label>
            <input type="text" name="lastname" value="<?php echo $name[0]?>"><br>
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" value="<?php echo $name[1]?>"><br>
            <label for="mail">Email</label>
            <input type="email" name="mail" value="<?php echo $mail?>"><br>
            <label for="birthday">Anniversaire</label>
            <input type="date" name="birthday" value="<?php echo $birthday?>"></br>
            <label for="password">Mot de passe actuel</label>
            <input type="password" name="password" required><br>
            <input type="submit" name="update" value="Modifier">

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
            echo "vos données ont étées mises à jour";
        }
        else if ($_SESSION['user']->update($id, $lastname, $firstname, $mail, $birthday, $password) == "mail")
        {
            echo 'cet email est déjà utilisé';
        }
    }
    else
    {
        echo "vous devez renseigner votre mot de passe actuel";
    }
}

?>
<section>
<h1>Modifier votre mot de passe</h1>
<form method="post" action="profil-client.php">
    <label for="oldpassword">Votre mot de passe actuel</label>
    <input type="password" name="oldpassword"></br>
    <label for="newpassword">Votre nouveau mot de passe</label>
    <input type="password" name="newpassword"></br>
    <label for="cnewpassword">Confirmez votre nouveau mot de passe</label>
    <input type="password" name="cnewpassword"></br>
    <input type="submit" name="updatepassword" value="Modifier">

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
        echo "votre mot de passe a été modifié";
    }
    else if($_SESSION['user']->updatePassword($id, $oldpassword, $newpassword, $cnewpassword) == "oldmdp")
    {
        echo "votre mot de passe actuel est incorrect";
    }
    else if($_SESSION['user']->updatePassword($id, $oldpassword, $newpassword, $cnewpassword) == "match")
    {
        echo "votre nouveau mot de passe et votre confirmation de mot de passe sont différents";
    }
    else if($_SESSION['user']->updatePassword($id, $oldpassword, $newpassword, $cnewpassword) == "missing")
    {
        echo "veuillez renseigner les informations demandées";
    }
}

?>
<section>
    <h1>Supprimer votre compte</h1>
    <span>Attention, cette action est irréversible</span>
    <form method="post">
    <input type="submit" name="delete" value="Supprimer">
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
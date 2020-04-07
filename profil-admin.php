<html>

<?php

require 'class/bdd.php';
require 'class/user.php';

session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
$admin = $_SESSION['user']->getGrade();
echo $admin;

?>

<head>
        <title>Mon compte</title> 
        <link rel="stylesheet" href="css/style.css">
</head>



<body>

    <?php require 'include/header.php'?>

<main>


</main>

    <?php require 'include/footer.php'?>

</body>

</html>
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
    <table>
        <thead>
            <tr>
                <td>Date de la commande</td>
                <td>Quantité d'objet</td>
                <td>Prix total</td>
                <td>Moyen de paiement</td>
                <td>Adresse</td>
            </tr>
        </thead>
        <tbody>
<?php
    $id = $_SESSION['user']->getId();

    $purchase = $_SESSION['user']->getPurchases($id);



    foreach($purchase as $pur)
    {
        $i = $pur['id'];

        $quantity = $_SESSION['user']->getQuantity($i);
        ?>
        <tr>
            <td><?php echo $pur['date']?></td>
            <td><?php echo $quantity?></td>
            <td><?php echo $pur['price']?></td>
            <td><?php echo $pur['means']?></td>
            <td><?php echo $pur['name_adresse']?></td>
            <td><a href='purchase.php?purchase=<?php echo $i?>'>Voir le détail</a></td>
        </tr>
        <?php
    }
    if(isset($_GET['purchase']))
    {
        $id = $_GET['purchase'];

        $product = $_SESSION['user']->getPurchase_Product($id);

?>
<table>
    <thead>
        <tr>
            <td>Nom du produit</td>
            <td>Prix à l'unité</td>
            <td>Quantité</td>
            <td>Prix total</td>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach($product as $pro)
        {
            $total_price = $pro['price'] * $pro['quantity'];
            ?>
            <tr>
                <td><?php echo $pro['name']?></td>
                <td><?php echo $pro['price']?></td>
                <td><?php echo $pro['quantity']?></td>
                <td><?php echo $total_price?></td>
            </tr>
            <?php
        }



    }
?>
    </tbody>
</table>

    </tbody>
    </table>
</main>

    <?php require 'include/footer.php'?>

</body>

</html>
<html>

<?php

require 'class/bdd.php';
require 'class/user.php';
require 'class/wish.php';

session_start();

if(!isset($_SESSION['user'])){
  header('Location:index.php');
}
if(!isset($_SESSION['wishlist']))
{
    $_SESSION['wishlist'] = new wish;
}

$id_user = $_SESSION['user']->getId();

?>

<head>
        <title>Mon compte</title> 
        <link rel="stylesheet" href="css/style.css">
</head>



<body>

    <?php require 'include/header.php'?>

<main>
<?php

    $wishlist = $_SESSION['wishlist']->getWishlist($id_user);


?>
<div>
<table>
    <thead>
        <tr>
        <td>Votre wishlist<td>
        <tr>
    </thead>
    <tbody>
        <tr>
            <td>              </td>
            <td>Nom du produit</td>
            <td>Prix</td>
        </tr>

<?php
    foreach($wishlist as $product)
    {
        $wishlist_product = $_SESSION['wishlist']->getProduct($product['id_product']);

        foreach($wishlist_product as $products)
        {
            ?>
            <tr>
            <td><img src="<?php echo $products['img']?>"></td>
            <td><?php echo $products['name']?></td>
            <td><?php echo $products['price']?> rubis</td>
            
            <?php
            if($products['quantity'] < 10)
            {
                ?>
                <td>Attention, dernières pièces !</td>
                <?php
            }
            ?>
            </tr>
            <?php
        }
        
    }

?>
    </tbody>
</table>
</div>
</main>

    <?php require 'include/footer.php'?>

</body>

</html>
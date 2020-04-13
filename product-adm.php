<?php
    $cat_p = $_SESSION['admin']->getAllSub_cat();
?>

        <form action="" method="post">
                    <label class="label" for="catp-select">Choisissez la sous-catégorie actuelle du produit à modifier:</label>

                        <select class="select" name="catp-select">
                            <?php
                        foreach($cat_p as $p)
                        {
                            ?>
                            <option value="<?php echo $p['id']?>"><?php echo $p['name'];?></option>
                            <?php
                        }
                            ?>
                            
                            <option value="add-product">Ajouter un produit</option>
                        </select>
                        <input class="button_form" type="submit" name="choose-catp">
                    </form>
<?php
if(isset($_POST['choose-catp']) && $_POST['catp-select'] != "add-product")
{
    $id_subcat = $_POST['catp-select'];

    $product = $_SESSION['admin']->getProduct($id_subcat);


    ?>
    <form action="" method="post">
                    <label class="label" for="product-select">Choisissez le produit à modifier:</label>

                        <select class="select" name="product-select">
                            <?php
                        foreach($product as $pro)
                        {
                            ?>
                            <option value="<?php echo $pro['id']?>"><?php echo $pro['name'];?></option>
                            <?php
                        }
                            ?>
                    
                        </select>
                        <input class="button_form" type="submit" name="choose-product">
                    </form>
                    <?php

}
else if(isset($_POST['choose-catp']) && $_POST['catp-select'] == "add-product")
{
   ?>
        <form action="" method="post">
            <label class="label" for="img_pro">Image du produit</label></br>
            <input class="input" type="file" name="img_pro" accept="image/png"></br>
            <label class="label" for="name_pro">Nom du produit</label></br>
            <input class="input" type="text" name="name_pro" required></br>
            <label class="label" for="des_pro">Description du produit</label></br>
            <textarea class="input" name="des_pro" rows="8" cols="33" required></textarea></br>
            <label class="label" for="price">Prix du produit</label></br>
            <input class="input" type="number" name="price" required></br>
            <label class="label" for="quantity">Stock</label></br>
            <input class="input" type="number" name="quantity" required></br>
            <label class="label" for="id_subcategory">Sous-catégorie propriétaire</label>
                <select class="select" name="id_subcategory">
                    <?php
                foreach($cat_p as $p)
                    {
                        ?>
                        <option value="<?php echo $p['id']?>">
                        <?php echo $p['name'];?></option>
                        <?php
                    }
                        ?>
                </select></br>
            <input class="button_form" type="submit" name="create_product" value="Ajouter un produit">
    </form>
<?php
}

if(isset($_POST['create_product']))
{
    $name_pro = $_POST['name_pro'];
    $des_pro = $_POST['des_pro'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $id_subcat = $_POST['id_subcategory'];
    $date = date('Y-m-d');
    $img_pro = $_POST['img_pro'];
    $url_img = $_SESSION['admin']->createUrl($id_subcat, $img_pro);
    $img = $_SESSION['admin']->sans($url_img);


    if($_SESSION['admin']->createProduct($name_pro, $des_pro, $img, $price, $quantity, $date, $id_subcat) == "all good")
    {
        ?>
        <span class="alert">Votre produit à bien été créer</span>
        <?php
    }
    else if($_SESSION['admin']->createProduct($name_pro, $des_pro, $img, $price, $quantity, $date, $id_subcat) == "name")
    {
        ?>
        <span class="alert">Un produit existant porte déjà ce nom</span>
        <?php
    }
    else if($_SESSION['admin']->createProduct($name_pro, $des_pro, $img, $price, $quantity, $date, $id_subcat) == "missing")
    {
        ?>
        <span class="alert">Merci de remplir toutes les informations</span>
        <?php
    }

}
if(isset($_POST['choose-product']))
{
        $i = $_POST['product-select'];
        
        $prod = $_SESSION['admin']->getOneProduct($i);


        foreach($prod as $obj)
        {
            ?>
            <form action="" method="post">
                <label class="label" for="img_pro">Image du produit</label></br>
                <img class="img_form" src="<?php echo $obj['img']?>"/></br>
                <input class="input" type="file" name="img" accept="image/png"></br>
                <label class="label" for="name_pro">Nom du produit</label></br>
                <input class="input" type="text" name="name_pro" value="<?php echo $obj['name']?>" required></br>
                <label class="label" for="des_pro">Description du produit</label></br>
                <textarea class="input" name="des_pro" rows="8" cols="33" required><?php echo $obj['description']?></textarea></br>
                <label class="label" for="price">Prix du produit</label></br>
                <input class="input" type="number" name="price" value="<?php echo $obj['price']?>" required></br>
                <label class="label" for="quantity">Quantité restante</label></br>
                <input class="input" type="number" name="quantity" value="<?php echo $obj['quantity']?>" required></br>
                <label class="label" for="id_subcategory">Sous-catégorie propriétaire</label>
                    <select class="select" name="id_subcategory">
                        <?php
                    foreach($cat_p as $p)
                        {
                            ?>
                            <option value="<?php echo $p['id']?>"
                            <?php
                            if($p['id'] == $obj['id_subcat'])
                            echo "selected"
                            ?>>
                            <?php echo $p['name'];?></option>
                            <?php
                        }
                            ?>
                    </select></br>
                <input class="button_form" type="submit" name="update_product" value="Modifier ce produit">
                <input class="button_form" type="submit" name="delete_product" value="Supprimer ce produit">

            </form>
            <?php
        }
    }
    if(isset($_POST['update_product']))
    {
        $id_subcat = $_POST['id_subcategory'];
        $id = $_SESSION['admin']->getIdProduct();
        $name_product = $_POST['name_pro'];
        $des_product = $_POST['des_pro'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        if($_POST['img'] == NULL)
        {
            $img = $_SESSION['admin']->getImgProduct();
        }
        else if($_POST['img'] != NULL)
        {
            $img_product = $_POST['img'];
            $url_img = $_SESSION['admin']->createUrl($id_subcat, $img_product);
            $img = $_SESSION['admin']->sans($url_img);
        }

        if($_SESSION['admin']->updateProduct($id, $name_product, $des_product, $price, $quantity, $id_subcat, $img) == "good")
        {
            ?>
            <span class="alert">Le produit à été modifié</span>
            <?php
        }
        else
        {
            ?>
            <span class="alert">Une erreur est survenue</span>
            <?php
        }
    }
    if(isset($_POST['delete_product']))
    {
        $id = $_SESSION['admin']->getIdProduct();
        $_SESSION['admin']->deleteProduct($id);
        ?>
        <span class="alert">Le produit a bien été supprimé</span>
        <?php
    }

?>
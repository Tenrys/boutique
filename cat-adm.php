   
<?php
    $category = $_SESSION['admin']->getAllCat();
?>

        <form action="" method="post">
                    <label class="label" for="cat-select">Choisissez une catégorie à modifier:</label>

                        <select class="select" name="cat-select">
                            <?php
                        foreach($category as $cat)
                        {
                            ?>
                            <option value="<?php echo $cat['id']?>"><?php echo $cat['name'];?></option>
                            <?php
                        }
                            ?>
                            <option value="add-cat">Ajouter une catégorie</option>
                    
                        </select>
                        <input class="button_form" type="submit" name="choose-cat">
                    </form>
<?php

    if(isset($_POST['choose-cat']) && $_POST['cat-select'] != "add-cat")
    {
        $i = $_POST['cat-select'];
        
        $one_cat = $_SESSION['admin']->getOneCat($i);

        foreach($one_cat as $arg)
        {
            ?>
            <section>
                <form action="" method="post">
                    <label class="label" for="name_cat">Nom de la catégorie</label>
                    <input class="input" type="text" name="name_cat" value="<?php echo $arg['name']?>">
                    <label class="label" for="des_cat">Description de la catégorie</label>
                    <textarea class="input" name="des_cat"  rows="5" cols="33"><?php echo $arg['description']?></textarea>
                    <input class="button_form" type="submit" name="update_cat" value="Modifier cette catégorie">
                    <input class="button_form" type="submit" name="delete_cat" value="Supprimer cette catégorie">
                </form> 
            </section>
            <?php
        }
    }
    else if(isset($_POST['choose-cat']) && $_POST['cat-select'] == "add-cat")
    {
        ?>
        <section>
            <form action="" method="post">
                    <label class="label" for="name_cat">Nom de la catégorie</label>
                    <input class="input" type="text" name="name_cat" required>
                    <label class="label" for="des_cat">Description de la catégorie</label>
                    <textarea class="input" name="des_cat"  rows="5" cols="33" required></textarea>
                    <input class="button_form" type="submit" name="create_cat" value="Ajouter une catégorie">
            </form>
        </section>
        <?php
    }
    if(isset($_POST["update_cat"]))
    {
        $name_cat = $_POST['name_cat'];
        $des_cat = $_POST['des_cat'];
        $id = $_SESSION['admin']->getidCat();
        if($_SESSION['admin']->updateCat($id,$name_cat,$des_cat) == "good")
        {
        ?>
        <span class="alert">Votre catégorie a bien été mofidiée</span>
        <?php
        }
        else
        {
            ?>
            <span class="alert">Une erreur est survenue</span>
            <?php
        }
    }
    if(isset($_POST["delete_cat"]))
    {
        $id = $_SESSION['admin']->getIdCat();
        $_SESSION['admin']->deleteCat($id);
        ?>
        <span class="alert">La catégorie a été supprimée</span>
        <?php

    }
    if(isset($_POST['create_cat']))
    {
        $name_cat = $_POST['name_cat'];
        $des_cat = $_POST['des_cat'];
        
        if($_SESSION['admin']->createCat($name_cat,$des_cat) == "all good" )
        {
            ?>
            <span class="alert">La catégorie a été ajoutée</span>
            <?php
        }
        else if($_SESSION['admin']->createCat($name_cat,$des_cat) == "name" )
        {
            ?>
            <span class="alert">Une catégorie existante porte déjà ce nom</span>
            <?php
        }
        else if($_SESSION['admin']->createCat($name_cat,$des_cat) == "missing" )
        {
            ?>
            <span class="alert">Merci de renseigner les informations demandées</span>
            <?php
        }

    }
    ?>

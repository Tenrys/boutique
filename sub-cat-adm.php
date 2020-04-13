   
<?php
    $subcat = $_SESSION['admin']->getAllSub_cat();
?>
        <form action="" method="post">
                    <label class="label" for="subcat-select">Choisissez une sous-catégorie à modifier:</label>

                        <select class="select" name="subcat-select">
                            <?php
                        foreach($subcat as $sub)
                        {
                            ?>
                            <option value="<?php echo $sub['id']?>"><?php echo $sub['name'];?></option>
                            <?php
                        }
                            ?>
                            <option value="add-sub">Ajouter une sous-catégorie</option>
                    
                        </select>
                        <input class="button_form" type="submit" name="choose-sub">
                    </form>
                    <?php

    if(isset($_POST['choose-sub']) && $_POST['subcat-select'] != "add-sub")
    {
        $i = $_POST['subcat-select'];
        
        $one_subcat = $_SESSION['admin']->getOneSub_cat($i);

        $category = $_SESSION['admin']->getAllCat();

        foreach($one_subcat as $subs)
        {
            ?>
            <section>
                <form action="" method="post">
                    <label class="label" for="name_subcat">Nom de la sous-catégorie</label>
                    <input class="input" type="text" name="name_subcat" value="<?php echo $subs['name']?>">
                    <label class="label" for="des_subcat">Description de la sous-catégorie</label>
                    <textarea class="input" name="des_subcat"  rows="5" cols="33"><?php echo $subs['description']?></textarea>
                    <label class="label" for="id_category">Catégorie propriétaire</label>
                    <select class="select" name="id_category">
                    <?php
                    foreach($category as $cat)
                        {
                            ?>
                            <option value="<?php echo $cat['id']?>"
                            <?php
                            if($cat['id'] == $subs['id_category'])
                            echo "selected"
                            ?>>
                            <?php echo $cat['name'];?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                    <input class="button_form" type="submit" name="update_sub" value="Modifier cette sous-catégorie">
                    <input class="button_form" type="submit" name="delete_sub" value="Supprimer cette sous-catégorie">
                </form> 
            </section>
            <?php
        }
    }
    else if(isset($_POST['choose-sub']) && $_POST['subcat-select'] == "add-sub")
    {
        $category = $_SESSION['admin']->getAllCat();

        ?>
        <section>
            <form action="" method="post">
                    <label class="label" for="name_subcat">Nom de la sous-catégorie</label>
                    <input class="input" type="text" name="name_subcat" required>
                    <label class="label" for="des_subcat">Description de la sous-catégorie</label>
                    <textarea class="input" name="des_subcat"  rows="5" cols="33" required></textarea>
                    <label class="label" for="id_category">Catégorie propriétaire</label>
                    <select class="select" name="id_category">
                    <?php
                    foreach($category as $cat)
                        {
                            ?>
                            <option value="<?php echo $cat['id']?>">
                            <?php echo $cat['name'];?>
                            </option>
                            <?php
                        }
                    ?>
                    </select>
                    <input class="button_form" type="submit" name="create_sub" value="Ajouter une sous-catégorie">
            </form>
        </section>
        <?php
    }
    if(isset($_POST["update_sub"]))
    {
        $name_subcat = $_POST['name_subcat'];
        $des_subcat = $_POST['des_subcat'];
        $id_cat = $_POST['id_category'];
        $id = $_SESSION['admin']->getIdSub_Cat();
        if($_SESSION['admin']->updateSub_Cat($id,$name_subcat,$des_subcat,$id_cat) == "good")
        {
        ?>
        <span class="alert">Votre sous-catégorie a bien été mofidiée</span>
        <?php
        }
        else
        {
            ?>
            <span class="alert">Une erreur est survenue</span>
            <?php
        }
    }
    if(isset($_POST["delete_sub"]))
    {
        $id = $_SESSION['admin']->getIdSub_Cat();
        $_SESSION['admin']->deleteSub_Cat($id);
        ?>
        <span class="alert">La sous-catégorie a été supprimée</span>
        <?php

    }
    if(isset($_POST['create_sub']))
    {
        $name_subcat = $_POST['name_subcat'];
        $des_subcat = $_POST['des_subcat'];
        $id_cat = $_POST['id_category'];
        
        if($_SESSION['admin']->createSub_Cat($name_subcat,$des_subcat,$id_cat) == "all good" )
        {
            ?>
            <span class="alert">La sous-catégorie a été ajoutée</span>
            <?php
        }
        else if($_SESSION['admin']->createSub_Cat($name_subcat,$des_subcat,$id_cat) == "name" )
        {
            ?>
            <span class="alert">Une sous-catégorie existante porte déjà ce nom</span>
            <?php
        }
        else if($_SESSION['admin']->createSub_Cat($name_subcat,$des_subcat,$id_cat) == "missing" )
        {
            ?>
            <span class="alert">Merci de renseigner les informations demandées</span>
            <?php
        }

    }
    ?>
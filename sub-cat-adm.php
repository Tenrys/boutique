   
<?php
    $subcat = $_SESSION['admin']->getAllSub_cat();
?>
        <form action="" method="post">
                    <label for="subcat-select">Choisissez une sous-catégorie à modifier:</label>

                        <select name="cat-select">
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
                        <input type="submit" name="choose-sub">
                    </form>
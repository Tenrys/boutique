   
<?php
    $category = $_SESSION['admin']->getAllCat();
?>
        <form action="" method="post">
                    <label for="cat-select">Choisissez une catégorie à modifier:</label>

                        <select name="cat-select">
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
                        <input type="submit" name="choose-cat">
                    </form>
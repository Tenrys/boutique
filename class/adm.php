<?php

class admin extends bdd
{
    public $id_cat = "";
    public $id_sub_cat = "";
    public $id_product = "";

    public function getAllCat()
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM category");
        $request->execute();
        $result = $request->fetchAll();
        return($result);
    }

    public function getAllSub_cat()
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM sub_category");
        $request->execute();
        $result = $request->fetchAll();
        return($result);
    }

    public function getProduct($id_subcat)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM product WHERE id_subcat = '$id_subcat");
        $request->execute();
        $result = $request->fetchAll();
        return($result);
    }

    public function getOneCat($i)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM category WHERE id = '$i'");
        $request->execute();
        $result = $request->fetchAll();
        $this->id_cat = $i;
        return($result);
    }

    public function getOneSub_cat($i)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM sub_category WHERE id = '$i'");
        $request->execute();
        $result = $request->fetchAll();
        $this->id_sub_cat = $i;
        return($result);
    }

    public function getOneProduct($i)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM product WHERE id = '$i'");
        $request->execute();
        $result = $request->fetchAll();
        $this->id_product = $i;
        return($result);
    }

    public function updateCat($id, $name_cat, $des_cat)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("UPDATE category SET name = '$name_cat', description = '$des_cat' WHERE id = '$id'");
        $request->execute();
        return("good");
    }

    public function updateSub_Cat($id,$name_subcat,$des_subcat,$id_cat)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("UPDATE sub_category SET name = '$name_subcat', description = '$des_subcat', id_category = '$id_cat' WHERE id = '$id'");
        $request->execute();
        return("good");
    }

    public function getIdCat()
    {
        $id = $this->id_cat;
        return($id);
    }

    public function getIdSub_Cat()
    {
        $id = $this->id_sub_cat;
        return($id);
    }

    public function getIdProduct()
    {
        $id = $this->id_product;
        return($id);
    }

    public function deleteCat($id)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("DELETE FROM category WHERE id = '$id'");
        $request->execute();
    }

    public function deleteSub_Cat($id)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("DELETE FROM sub_category WHERE id = '$id'");
        $request->execute();
    }

    public function deleteProduct($id)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("DELETE FROM product WHERE id = '$id'");
        $request->execute();
    }


    public function createCat($name_cat, $des_cat)
    {
        if($name_cat != NULL && $des_cat != NULL)
        {
            $connexion = $this->connect();
            $request = $connexion->prepare("SELECT name FROM category WHERE name = '$name_cat'");
            $request->execute();
            $check = $request->rowCount();
            if($check == 0 )
            {
            $request = $connexion->prepare("INSERT INTO category (name, description) VALUES ('$name_cat' , '$des_cat')");
            $request->execute();
            return("all good");
            }
            else
            {
                return("name");
            }
        }
        else
        {
            return "missing";
        }
    }

    public function createSub_Cat($name_subcat, $des_subcat, $id_cat)
    {
        if($name_subcat != NULL && $des_subcat != NULL && $id_cat != NULL)
        {
            $connexion = $this->connect();
            $request = $connexion->prepare("SELECT name FROM sub_category WHERE name = '$name_subcat'");
            $request->execute();
            $check = $request->rowCount();
            if($check == 0 )
            {
            $request = $connexion->prepare("INSERT INTO sub_category (name, description, id_category) VALUES ('$name_subcat' , '$des_subcat', '$id_cat')");
            $request->execute();
            return("all good");
            }
            else
            {
                return("name");
            }
        }
        else
        {
            return "missing";
        }
    }




}
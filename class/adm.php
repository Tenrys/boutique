<?php

class admin extends bdd
{
    public $id_cat = "";
    public $id_sub_cat = "";
    public $id_product = "";
    public $img = "";

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
        $request = $connexion->prepare("SELECT * FROM product WHERE id_subcat = '$id_subcat'");
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
        $this->img = $result[0][3];
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

    public function updateProduct($id, $name_product, $des_product,$price, $quantity, $id_subcat,$img)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("UPDATE product SET name = '$name_product', description = '$des_product', img = '$img', price = '$price', quantity = '$quantity', id_subcat = '$id_subcat' WHERE id = '$id'");
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

    public function getImgProduct()
    {
        $img = $this->img;
        return($img);
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

    public function createProduct($name_pro, $des_pro, $img, $price, $quantity, $date, $id_subcat)
    {
        if($name_pro != NULL && $des_pro != NULL && $img != NULL && $price != NULL && $quantity != NULL && $id_subcat != NULL)
        {
            $connexion = $this->connect();
            $request = $connexion->prepare("SELECT name FROM product WHERE name = '$name_pro'");
            $request->execute();
            $check = $request->rowCount();
            if($check == 0 )
            {
            $request = $connexion->prepare("INSERT INTO product (name, description, img, price, quantity, date, id_subcat) VALUES ('$name_pro' , '$des_pro', '$img', '$price', '$quantity','$date', '$id_subcat')");
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

    public function insertId($id)
    {
        $this->id_product = $id;
    }

    public function createUrl($id_subcat, $img)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT name, id_category FROM sub_category WHERE id = '$id_subcat'");
        $request->execute();
        $result = $request->fetchAll();
        $name_subcat = $result[0]['name'];
        $namesubcat = explode(" ",$name_subcat);
        $name_subcat = $namesubcat[0];
        $id_cat = $result[0]['id_category'];
        $requete = $connexion->prepare("SELECT name FROM category WHERE id = '$id_cat'");
        $requete->execute();
        $resultat = $requete->fetchAll();
        $name_cat = $resultat[0]['name'];
        $namecat = explode(" ",$name_cat);
        $name_cat = $namecat[0];
        $url = "img/product/".$name_cat."/".$name_subcat."/".$img;
        $url = mb_strtolower($url);
        return($url);
        
    }

    function sans($url)
		{
			$search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
			$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');

			$url = str_replace($search, $replace, $url);
			return ($url);
		}




}
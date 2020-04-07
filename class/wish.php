<?php

class wish extends bdd{

    public $id = "";
    public $id_user = "";
    public $id_product ="";


    public function createWishlist($id_product, $id_user)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("INSERT INTO wishlist (id_product, id_user) VALUES ('$id_product' , '$id_user')");
        $request->execute();
    }

    public function getWishlist($id_user)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT id_product FROM wishlist WHERE id_user = '$id_user'");
        $request->execute();
        $result = $request->fetchAll();
        return($result);
    }

    public function getProduct($id)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT name, img, price, quantity FROM product WHERE id = '$id'");
        $request->execute();
        $result = $request->fetchAll();
        return($result);
    }








}






?>

<?php

class admin extends bdd
{

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








}
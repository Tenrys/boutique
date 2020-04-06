<?php 


class adress extends bdd{

    private $id = "";
    public $adress = "";
    public $zip_code = "";
    public $city = "";
    public $country = "";
    public $id_user = "";
    public $name_adress = "";

    public function createAdress($adress, $zip_code, $city, $country,$name_adress, $id_user)
    {
        if($adress != NULL && $zip_code != NULL && $city != NULL && $country != NULL && $id_user != NULL && $name_adress != NULL)
        {
            $connexion = $this->connect();
            $request = $connexion->prepare("INSERT INTO adress (adresse, zip_code, city, country, name_adresse, id_user) VALUES ('$adress' , '$zip_code', '$city', '$country', '$name_adress', '$id_user')");
            $request->execute();
            return("all good");
        }
        else
        {
            return "missing";
        }
    }
}



?>
<?php 


class adress extends bdd{

    private $id = "";
    public $adress = "";
    public $zip_code = "";
    public $city = "";
    public $country = "";
    public $id_user = "";
    public $name_adress = "";

    public function createAdress($adress, $zip_code, $city, $country, $id_user, $name_adress)
    {
        if($adress != NULL && $zip_code != NULL && $city != NULL && $country != NULL && $id_user != NULL && $name_adress != NULL)
        {
            $connexion = $this->connect();
            $request = $connexion->prepare("INSERT INTO adress (adresse, firstname, mail, birthday, password, grade, point) VALUES ('$lastname' , '$firstname', '$mail', '$birthday', '$password', 'membre', '$point')");
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
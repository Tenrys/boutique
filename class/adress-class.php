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
            $request = $connexion->prepare("SELECT name_adresse FROM adress WHERE name_adresse = '$name_adress' AND id_user = '$id_user'");
            $request->execute();
            $check = $request->rowCount();
            var_dump($check);
            if($check == 0 )
            {
            $request = $connexion->prepare("INSERT INTO adress (adresse, zip_code, city, country, name_adresse, id_user) VALUES ('$adress' , '$zip_code', '$city', '$country', '$name_adress', '$id_user')");
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

    public function getAllAdresses($id_user)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM adress WHERE id_user = '$id_user'");
        $request->execute();
        $result = $request->fetchAll();
        return($result);
    }

    public function getOneAdress($i)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("SELECT * FROM adress WHERE id = '$i'");
        $request->execute();
        $result = $request->fetchAll();
        return($result);
    }

    public function updateAdress($id, $adress, $zip_code, $city, $country,$name_adresse)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("UPDATE adress SET adresse = '$adress', zip_code = '$zip_code', city = '$city', country = '$country', name_adresse = '$name_adresse' WHERE id = '$id'");
        $request->execute();
        return("good");
    }

    public function deleteAdress($id)
    {
        $connexion = $this->connect();
        $request = $connexion->prepare("DELETE FROM adress WHERE id = '$id'");
        $request->execute();
    }
}



?>
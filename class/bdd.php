<?php

class bdd{

protected $connexion = "";

public function connect()
    {
        $connexion = new PDO('mysql:host=127.0.0.1;dbname=boutique', 'root', '');
        if($connexion == NULL){
            return false;
        }
        return($connexion);
    }

public function close()
    {
        mysqli_close($this->connexion);
    }
}

?>
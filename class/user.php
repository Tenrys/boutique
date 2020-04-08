<?php


class user extends bdd{

        private $id = "";
        public $lastname = "";
        public $firstname = "";
        public $mail = "";
        public $birthday = "";
        public $point = "";
        private $password = "";
        private $grade = "";


        public function register($lastname, $firstname, $mail, $birthday, $point, $password, $cpassword, $grade){
            if($lastname != NULL && $firstname != NULL && $mail != NULL && $birthday != NULL && $password != NULL && $cpassword != NULL)
            {
                if($password == $cpassword)
                {   
                    $connexion = $this->connect();
                   // var_dump($connexion);
                    $request = $connexion->prepare("SELECT id FROM user WHERE mail = '$mail'");
                    $request->execute();
                    $check = $request->rowCount();
                    if($check == 0)
                    {
                        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 15));
                        $request = $connexion->prepare("INSERT INTO user (lastname, firstname, mail, birthday, password, grade, point) VALUES ('$lastname' , '$firstname', '$mail', '$birthday', '$password', 'membre', '$point')");
                        $request->execute();
                        return("all good");
                    }
                    else
                    {
                        return("email");
                    }

                }
                else
                {
                    return("mdp");
                }
            }
            else
            {
                return("empty");
            }
        }

        public function login($mail, $password){
            $connexion = $this->connect();
            $request = $connexion->prepare("SELECT id FROM user WHERE mail = '$mail'");
            $request->execute();
            $check = $request->rowCount();
            if($check == 1){
                $request = $connexion->prepare("SELECT password FROM user WHERE mail = '$mail'");
                $request->execute();
                $result = $request->fetchAll();
                $pass = $result[0][0];
                $checkpass = password_verify($password, $pass);
                if($checkpass == true){
                    $request = $connexion->prepare("SELECT id, lastname, firstname, mail, birthday, point, grade FROM user WHERE mail = '$mail'");
                    $request->execute();
                    $data = $request->fetchAll();
                    $this->id = $data[0][0];
                    $this->lastname = $data[0][1];
                    $this->firstname = $data[0][2];
                    $this->mail = $data[0][3];
                    $this->birthday = $data[0][4];
                    $this->point = $data[0][5];
                    $this->grade = $data[0][6];
                    return("ok");
                }
                else{
                    return("mdp");
                }
            }
            else{
                return("mail");
            }
        }

        public function update($id,$lastname, $firstname, $mail, $birthday, $password)
        {
            $connexion = $this->connect();
            $request = $connexion->prepare("SELECT id FROM user WHERE mail = '$mail'");
            $request->execute();
            $gid = $request->fetchAll();
            $check = $request->rowCount();
            if($check == 0 || $gid[0][0] == $id)
            {
                $request = $connexion->prepare("SELECT password FROM user WHERE id = '$id'");
                $request->execute();
                $result = $request->fetchAll();
                $pass = $result[0][0];
                $checkpass = password_verify($password, $pass);
                if($checkpass == true)
                {
                    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 15));
                    $request = $connexion->prepare("UPDATE user SET lastname = '$lastname', firstname = '$firstname', mail = '$mail', password = '$password', birthday = '$birthday' WHERE id = '$id'");
                    $request->execute();
                    $this->lastname = $lastname;
                    $this->firstname = $firstname;
                    $this->mail = $mail;
                    $this->birthday = $birthday;
                    return("good");
                }
                else
                {
                    return("mdp");
                }
            }
            else
            {
                return("mail");
            }
        }

        public function updatePassword($id, $oldpassword, $newpassword, $cnewpassword)
        {
            if($oldpassword != NULL && $newpassword != NULL && $cnewpassword != NULL)
            {
                if($newpassword == $cnewpassword)
                {
                    $connexion = $this->connect();
                    $request = $connexion->prepare("SELECT password FROM user WHERE id = '$id'");
                    $request->execute();
                    $result = $request->fetchAll();
                    $pass = $result[0][0];
                    $checkpass = password_verify($oldpassword, $pass);
                    if($checkpass == true)
                    {
                        $password = password_hash($newpassword, PASSWORD_BCRYPT, array('cost' => 15));
                        $request = $connexion->prepare("UPDATE user SET password = '$password' WHERE id = '$id'");
                        $request->execute();
                        return("very good");
                    }
                    else
                    {
                        return("oldmdp");
                    }
                }
                else
                {
                    return("match");
                }
            }
            else
            {
                return("missing");
            }
        }

        public function getPurchases($id)
        {
            $connexion = $this->connect();
            $requete = $connexion->prepare("SELECT purchase.id, purchase.price, purchase.means, purchase.date, adress.name_adresse FROM purchase INNER JOIN adress ON purchase.id_adress = adress.id WHERE purchase.id_user = '$id'");
            $requete->execute();
            $result = $requete->fetchAll();
            return($result);

        }

        public function getQuantity($id)
        {
            $connexion = $this->connect();
            $requete = $connexion->prepare("SELECT SUM(quantity) FROM purchase_product WHERE purchase_product.id_purchase
            = '$id'");
            $requete->execute();
            $result = $requete->fetch();
            return ($result[0]);
        }

        public function getPurchase_Product($id)
        {
            $connexion = $this->connect();
            $requete = $connexion->prepare("SELECT product.name, product.price, purchase_product.quantity FROM product INNER JOIN purchase_product ON purchase_product.id_product = product.id WHERE purchase_product.id_purchase = '$id'");
            $requete->execute();
            $result = $requete->fetchAll();
            return($result);
        }

        public function getId(){

            $id = $this->id;
            return($id);
        }

        public function getName(){
            $lastname = $this->lastname;
            $firstname = $this->firstname;
            return[$lastname, $firstname];
        }

        public function getBirthday(){
            $birthday = $this->birthday;
            return($birthday);
        }

        public function getPoints(){
            $points = $this->point;
            return($points);
        }

        public function getMail(){
            $mail = $this->mail;
            return($mail);
        }

        public function getGrade()
        {
            $grade = $this->grade;
            return($grade);
        }

        

        public function delete()
        {
                $id = $this->id;
                $connexion = $this->connect();
                $request = $connexion->prepare("DELETE FROM user WHERE id = '$id'");
                $request->execute();
                    
                
            
        }


        public function disconnect(){
            $this->id = NULL;
            $this->lastname = NULL;
            $this->firstname = NULL;
            $this->birthday = NULL;
            $this->mail = NULL;
            $this->grade = NULL;
            $this->point = NULL;
        }

        public function isConnected(){
            if ($this->id != null) {
                return true;
            } else {
                return false;
            }
        }





}





?>
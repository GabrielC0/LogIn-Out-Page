<?php

class BDD {

    public static function Connexion(){
        try {
            $bdd = new PDO("mysql:host=localhost;dbname=profile;charset=utf8", "root", "");
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $bdd;
        } catch (Exception $e) {
            echo "erreur $e";
        }
    }
}

$bdd = new BDD();
$bdd->Connexion();

?>
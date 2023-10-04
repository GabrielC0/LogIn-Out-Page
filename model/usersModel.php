<?php

include_once('bdd.php');

class UsersModel {

    private $bdd;

    public function __construct() {
        $this->bdd = BDD::Connexion();
    }

    public function getUserByEmail($email){
        $req = $this->bdd->prepare("SELECT * FROM Users WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
        $user = $req->fetch();
        return $user;
    }

    public function getUserById($id){
        $req = $this->bdd->prepare("SELECT * FROM Users WHERE id = :id");
        $req->execute(array(
            'id' => $id
        ));
        $user = $req->fetch();
        return $user;
    }

    public function setUser($nom, $prenom, $email, $password, $id){
        $req = $this->bdd->prepare("INSERT INTO Users (nom, prenom, email, password, id) VALUES (:nom, :prenom, :email, :password, :id)");
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
            'id' => $id
        ));
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['email'] = $email;
    }

}
<?php
// Inclure le fichier de configuration de la base de données
include_once('bdd.php');

class UsersModel {

    private $bdd;

    public function __construct() {
        // Initialiser la connexion à la base de données en utilisant la méthode statique de la classe BDD
        $this->bdd = BDD::Connexion();
    }

    // Récupérer un utilisateur en fonction de son email
    public function getUserByEmail($email){
        // Préparer une requête SQL avec un paramètre nommé ":email" pour éviter les injections SQL
        $req = $this->bdd->prepare("SELECT * FROM Users WHERE email = :email");
        $req->execute(array(
            'email' => $email
        ));
        $user = $req->fetch(); // Récupérer la première ligne du résultat
        return $user;
    }

    // Récupérer un utilisateur en fonction de son ID
    public function getUserById($id){
        // Préparer une requête SQL avec un paramètre nommé ":id" pour éviter les injections SQL
        $req = $this->bdd->prepare("SELECT * FROM Users WHERE id = :id");
        $req->execute(array(
            'id' => $id
        ));
        $user = $req->fetch(); // Récupérer la première ligne du résultat
        return $user;
    }

    // Insérer un nouvel utilisateur dans la base de données
    public function setUser($nom, $prenom, $email, $password, $id){
        // Préparer une requête SQL pour l'insertion d'un nouvel utilisateur
        $req = $this->bdd->prepare("INSERT INTO Users (nom, prenom, email, password, id) 
        VALUES (:nom, :prenom, :email, :password, :id)");
        $req->execute(array(
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'password' => $password,
            'id' => $id
        ));
        // Stocker les informations de l'utilisateur en session
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['email'] = $email;
    }

    public function setMessage($nom, $prenom, $email, $message) {
        // Préparer une requête SQL pour l'insertion d'un nouvel utilisateur
        $req = $this->bdd->prepare("INSERT INTO contact (nom, prenom, email, message) 
        VALUES (:nom, :prenom, :email, :message)");
        $req->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'message' => $message
        ]);
    }

}
?>

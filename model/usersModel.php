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
        // Préparer une requête SQL pour l'insertion d'un nouveau message dans la table 'contact'
        $req = $this->bdd->prepare("INSERT INTO contact (nom, prenom, email, message) 
        VALUES (:nom, :prenom, :email, :message)");
        // Exécuter la requête préparée en liant les valeurs des paramètres aux placeholders
        $req->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'message' => $message
        ]);
    }
    

    public function getUsers()
    {
        return $this->bdd->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    }
    // Cette méthode récupère tous les utilisateurs depuis une base de données en utilisant une requête SQL SELECT.
    // Ensuite, les résultats sont récupérés sous forme d'un tableau associatif grâce à PDO::FETCH_ASSOC.
    //Enfin, le tableau associatif contenant les données des utilisateurs est renvoyé en sortie de la fonction.
         
    public function updateUser($nom, $prenom, $email, $id){
    // Prépare une requête SQL pour mettre à jour les données de l'utilisateur dans la table 'users' en utilisant l'identifiant 'id' comme critère.
    $update = $this->bdd->prepare("UPDATE users SET nom=?,prenom=?,email=? WHERE id=?");
    // Exécute la requête préparée en remplaçant les placeholders par les valeurs des paramètres.
    if ($update->execute([$nom, $prenom, $email,$id])) {
        // Si la mise à jour est réussie, retourne vrai.
        return true;
    } else {
        // Si la mise à jour échoue, retourne faux.
        return false;
    }
}

}
?>

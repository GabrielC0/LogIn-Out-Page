<?php
// Inclure le modèle des utilisateurs
include_once('model/usersModel.php');

class UsersController {

    private $userModel;

    public function __construct() {
        // Initialiser le modèle des utilisateurs dans le constructeur
        $this->userModel = new UsersModel();
    }

    public function formConnexion() {
        include_once('view/connexion.php');
    }

    public function getConnexion() {
        // Vérifier si le formulaire de connexion a été soumis
        if(isset($_POST['email'])){
            // Vérifier si les champs email et mot de passe ne sont pas vides
            if(trim($_POST['email']) != "" && trim($_POST['password']) != ""){
                // Récupérer l'utilisateur correspondant à l'email saisi
                $user = $this->userModel->getUserByEmail($_POST['email']);
                if($user){
                    // Vérifier si le mot de passe saisi correspond à celui stocké dans la base de données
                    if(password_verify($_POST['password'], $user['password'])){
                        // Stocker les informations de l'utilisateur en session
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['prenom'] = $user['prenom'];
                        $_SESSION['email'] = $user['email'];
                        header('Location: index.php'); // Rediriger vers la page d'accueil
                    } else {
                        $error = "Mot de passe incorrect";
                        include_once('view/connexion.php');
                    }
                } else {
                    $error = "Email incorrect";
                    include_once('view/connexion.php');
                }
            } else {
                $error = "Veuillez remplir tous les champs";
                include_once('view/connexion.php');
            }
        } else {
            $this->formConnexion();
        }
    }

    public function formInscription() {
        // Afficher le formulaire d'inscription en incluant le fichier de vue correspondant
        include_once('view/inscription.php');
    }

    public function setInscription() {
        // Vérifier si le formulaire d'inscription a été soumis
        if(isset($_POST['nom'])){
            // Vérifier si tous les champs obligatoires sont remplis
            if(trim($_POST['nom']) != "" && trim($_POST['prenom']) != "" && trim($_POST['email']) != "" && trim($_POST['password']) != ""){
                // Vérifier si l'email n'est pas déjà utilisé par un autre utilisateur
                $user = $this->userModel->getUserByEmail($_POST['email']);
                if(!$user){
                    // Hasher le mot de passe avant de l'insérer dans la base de données
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // Insérer le nouvel utilisateur dans la base de données
                    $this->userModel->setUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $password, $_POST['id']);
                    header('Location: index.php'); // Rediriger vers la page d'accueil
                } else {
                    $error = "Email déjà utilisé";
                    include_once('view/inscription.php');
                }
            } else {
                $error = "Veuillez remplir tous les champs";
                include_once('view/inscription.php');
            }
        } else {
            $this->formInscription();
        }
    }

    public function formContact() {
        // Afficher le formulaire de contact en incluant le fichier de vue correspondant
        include_once('view/contact.php');
    }
    
    public function setContact() {
        // Vérifier si le formulaire d'inscription a été soumis
        if(isset($_POST['nom'])){
            // Vérifier si tous les champs obligatoires sont remplis
            if(trim($_POST['nom']) != "" && trim($_POST['prenom']) != "" && trim($_POST['email']) != "" && trim($_POST['message']) != ""){
                   
                $this->userModel->setMessage($_POST['nom'], $_POST['prenom'], $_POST['email'],$_POST['message']);
                header('Location: index.php'); // Rediriger vers la page d'accueil
                
            } else {
                $error = "Veuillez remplir tous les champs";
                include_once('view/contact.php');
            }
        } else {
            $this->formContact();
        }
    }
}
?>


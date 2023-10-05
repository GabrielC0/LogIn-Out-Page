<?php
// Inclure le modèle des utilisateurs
include_once('model/usersModel.php');

class UsersController {

    private $model;

    private $mdp;

    private $email;

    public function __construct() {
        // Initialiser le modèle des utilisateurs dans le constructeur
        $this->model = new UsersModel();
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
                $user = $this->model->getUserByEmail($_POST['email']);
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
                $user = $this->model->getUserByEmail($_POST['email']);
                if(!$user){
                    // Hasher le mot de passe avant de l'insérer dans la base de données
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    // Insérer le nouvel utilisateur dans la base de données
                    $this->model->setUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $password, $_POST['id']);
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
                   
                $this->model->setMessage($_POST['nom'], $_POST['prenom'], $_POST['email'],$_POST['message']);
                header('Location: index.php'); // Rediriger vers la page d'accueil
                
            } else {
                $error = "Veuillez remplir tous les champs";
                include_once('view/contact.php');
            }
        } else {
            $this->formContact();
        }
    }

    public function getUsers(){
    // Appelle la méthode getUsers() du modèle (probablement une classe de modèle) pour obtenir la liste des utilisateurs
    $users = $this->model->getUsers();
    // Inclut le fichier 'view/UsersList.php', qui sera responsable de l'affichage de la liste des utilisateurs
    include('view/UsersList.php');
    }

    public function monCompte(){
        // Appelle la méthode 'getUserById' du modèle pour obtenir les informations de l'utilisateur actuellement connecté (utilisant $_SESSION['id']).
        $user = $this->model->getUserById($_SESSION['id']);
        // Inclut le fichier 'view/moncompte.php', qui sera responsable de l'affichage des informations du compte de l'utilisateur.
        include('view/moncompte.php');
    }

    public function updateUser(){
        // Vérifie si le formulaire de mise à jour a été soumis (si le champ 'email' est présent dans la requête POST).
        if (isset($_POST['email'])) { 
            if (trim($_POST['nom']) == "" || trim($_POST['prenom']) == "" || trim($_POST['email']) == "") {
                // Vérifie si les champs 'nom', 'prenom', et 'email' sont vides ou contiennent uniquement des espaces.
                echo "merci de remplir les champs correctement"; // Affiche un message d'erreur.
                // Redirige l'utilisateur vers la page "monCompte".
                $this->monCompte(); 
            } else {
                // Si les champs sont valides, appelle la méthode 'updateUser' du modèle pour mettre à jour les informations de l'utilisateur.
                $user = $this->model->updateUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $_SESSION['id']);
                if ($user) {
                    // Si la mise à jour est réussie, met à jour les variables de session 'nom' et 'prenom' avec les nouvelles valeurs.
                    $_SESSION['nom'] = $_POST['nom'];
                    $_SESSION['prenom'] = $_POST['prenom'];
                    // Redirige l'utilisateur vers la page d'accueil.
                    header('location: index.php'); 
                    // Affiche un message de confirmation de la modification.
                    echo "modification OK"; 
                } else {
                    echo "modification KO"; 
                    // Redirige l'utilisateur vers la page "monCompte".
                    $this->monCompte(); 
                }
            }
        } else {
            // Si le formulaire n'a pas été soumis, redirige l'utilisateur vers la page "monCompte".
            $this->monCompte();
        }
    }
    
}
?>


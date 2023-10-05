<?php
// Inclure le modèle des utilisateurs et le contrôleur des utilisateurs
include_once('model/usersModel.php');
include_once('controller/usersController.php');

// Récupérer la valeur du paramètre 'page' dans l'URL
$page = @$_GET['page'];


switch ($page) {
    case 'inscription':
        // Créer une instance du contrôleur des utilisateurs
        $user = new UsersController();
        // Appeler la méthode 'setInscription' pour gérer l'inscription
        $user->setInscription();
        break;
    case 'connexion':
        // Créer une instance du contrôleur des utilisateurs
        $user = new UsersController();
        // Appeler la méthode 'getConnexion' pour gérer la connexion
        $user->getConnexion();
        break;
    case 'deconnexion':
        // Détruire la session
        session_destroy(); 
        // Rediriger vers la page d'accueil
        header('Location: index.php'); 
        break;
    case 'contact':
        include('view/contact.php');
        $user = new UsersController();
        $user->setContact();
        break;
    case'UsersList':
        $user = new UsersController();
        $user->getUsers();
        break;
    case 'monCompte':
        $user = new UsersController();
        $user->updateUser();
    break;
    default:
    include('view/accueil.php');
    break;
}
?>

<?php
// Inclure le modèle des utilisateurs et le contrôleur des utilisateurs
include_once('model/usersModel.php');
include_once('controller/usersController.php');

// Récupérer la valeur du paramètre 'page' dans l'URL
$page = @$_GET['page'];

// Utiliser une structure switch pour router les demandes en fonction de la valeur de 'page'
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
        session_destroy(); // Détruire la session
        header('Location: index.php'); // Rediriger vers la page d'accueil
        break;
    case 'contact':
        include('view/contact.php');
        $user = new UsersController();
        $user->setContact();
        break;
    default:
    include('view/accueil.php');
    break;
}
?>

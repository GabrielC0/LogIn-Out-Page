<?php
include_once('model/usersModel.php');
include_once('controller/usersController.php');
$page = @$_GET['page'];

switch($page){
    case 'inscription':
        $user = new UsersController();
        $user->setInscription();
        break;
    case 'connexion':
        $user = new UsersController();
        $user->getConnexion();
        break;
    case 'deconnexion':
        session_destroy();
        header('Location: index.php');
        break;
    default:
        include('view/accueil.php');
        break;
}
<?php
include_once('model/usersModel.php');

class UsersController {

    private $userModel;

    public function __construct() {
        $this->userModel = new UsersModel();
    }

    public function formConnexion() {
        include_once('view/connexion.php');
    }

    public function getConnexion() {
        if(isset($_POST['email'])){
            if(trim($_POST['email']) != "" && trim($_POST['password']) != ""){
                $user = $this->userModel->getUserByEmail($_POST['email']);
                if($user){
                    if(password_verify($_POST['password'], $user['password'])){
                        $_SESSION['nom'] = $user['nom'];
                        $_SESSION['prenom'] = $user['prenom'];
                        $_SESSION['email'] = $user['email'];
                        header('Location: index.php');
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
        include_once('view/inscription.php');
    }

    public function setInscription() {
        if(isset($_POST['nom'])){
            if(trim($_POST['nom']) != "" && trim($_POST['prenom']) != "" && trim($_POST['email']) != "" && trim($_POST['password']) != ""){
                $user = $this->userModel->getUserByEmail($_POST['email']);
                if(!$user){
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $this->userModel->setUser($_POST['nom'], $_POST['prenom'], $_POST['email'], $password, $_POST['id']);
                    header('Location: index.php');
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

}
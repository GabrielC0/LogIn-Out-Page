<?php

class Verification
{
    // Méthode pour vérifier si une adresse email est valide en utilisant filter_var
    public function verfEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    // Méthode pour vérifier si une adresse email est valide en utilisant une expression régulière
    public function verifEmail2($email)
    {
        if (preg_match("/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,4})$/", $email)) {
            return true; // L'adresse email est valide
        } else {
            return false; // L'adresse email n'est pas valide
        }
    }

    // Méthode pour vérifier si une chaîne de caractères contient un nom ou prénom valide
    public function nomPrenom($valeur)
    {
        if (preg_match("/^([a-zA-Z -]{1,30})$/", $valeur)) {
            return true; // Le nom ou prénom est valide
        } else {
            return false; // Le nom ou prénom n'est pas valide
        }
    }

    // Méthode pour vérifier si un numéro de téléphone est valide
    public function tel($tel)
    {
        if (preg_match("/^([0-9]{10})$/", $tel)) {
            return true; // Le numéro de téléphone est valide
        } else {
            return false; // Le numéro de téléphone n'est pas valide
        }
    }
}

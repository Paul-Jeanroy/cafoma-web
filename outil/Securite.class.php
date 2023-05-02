<?php
class Securite {
    public static function verifAccessAdmin(){
        return (isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] === "administrateur");
    }
    public static function verifAccessPartenaire(){
        return (isset($_SESSION['role']) && !empty($_SESSION['role']) && 
                ($_SESSION['role'] === "partenaire" || self::verifAccessAdmin()));
    }
    public static function verifAccessEtudiant(){
        return (isset($_SESSION['role']) && !empty($_SESSION['role']) && 
                ($_SESSION['role'] === "etudiant" || self::verifAccessPartenaire() || verifAccessAdmin())) ;
    }
    public static function isConnected(){
        return (isset($_SESSION['role']) && !empty($_SESSION['role']));
    }
    public static function autoriserCookie(){
        return (isset($_COOKIE['cookie-accept']));
    }
    public static function validerInputData($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
}

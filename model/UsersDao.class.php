<?php
require_once "Connexion.class.php";
require_once "User.class.php";

class UsersDao extends Connexion {
    private static $_instance = null;

    private function __construct() {}
    
    public static function getInstance() {
        if(is_null(self::$_instance)){
            self::$_instance = new UsersDao();  
        }
        return self::$_instance;
    } 
    function getPasswdHashUser($login){
        $pdo = $this->getBdd();
        $req = "SELECT password FROM utilisateur WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $passwd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $passwd['password'];
    }    
    function findAllUser(){
        $stmt = $this->getBdd()->prepare("SELECT * FROM utilisateur");
        $stmt->execute();
        $bddUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        foreach($bddUsers as $user){
            $u=new User($user['login'], $user['password'],$user['mail'], $user['role'],$user['image'], $user['est_valide']);
            $this->users[]=$u;
        }
        return $this->users;
    }
    function supprimerCompte($login){
        $pdo = $this->getBdd();
        $req = "DELETE FROM utilisateur WHERE login = :login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    function supprimerAllInscriptionBylogin($login){
        $pdo = $this->getBdd();
        $req = "DELETE FROM utilisateur_formation_inscrire WHERE login = :login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    function createUser($user, $cle) {  
        echo "user=".$user->getLogin()."<br>";
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO utilisateur (login, password, mail, role, image, est_valide, clef)
        values (:login, :password, :mail, :role, :image, :est_valide, :clef)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$user->getLogin(),PDO::PARAM_STR);
        $stmt->bindValue(":password",$user->getPassword(),PDO::PARAM_STR);
        $stmt->bindValue(":mail",$user->getMail(),PDO::PARAM_STR);
        $stmt->bindValue(":role",$user->getRole(),PDO::PARAM_STR);
        $stmt->bindValue(":image",$user->getImage(),PDO::PARAM_STR);
        $stmt->bindValue(":est_valide",$user->getEstValide(),PDO::PARAM_INT);
        $stmt->bindValue(":clef",$cle,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();  
        if($resultat > 0){
            return true;
        }
        else {
            return false;
        }
    }
    function validerCompte($login,$cle){
        $pdo = $this->getBdd();
        $req = "UPDATE utilisateur SET est_valide = 1 WHERE login = :login AND clef = :cle";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":cle",$cle,PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        if($estModifier){
            return true;
        }
        else {
            return false;
        }
    }
    function isExistLoginUser($login){
        $pdo = $this->getBdd();
        $req = "SELECT count(login) AS nb FROM utilisateur WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $nbUserTab = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        return ($nbUserTab['nb'] > 0);
    }
    function isValidUser($login){
        $pdo = $this->getBdd();
        $req = "SELECT est_valide AS isvalid FROM utilisateur WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $estValid = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        return $estValid['isvalid'];
    }
    function getRoleByLogin($login){
        $pdo = $this->getBdd();
        $req = "SELECT role FROM utilisateur WHERE login=:login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $role['role'];
    }
    function findUserByLogin($login){
        $stmt = $this->getBdd()->prepare("SELECT * FROM utilisateur WHERE login=:login");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $u=new User($user['login'], $user['password'],$user['mail'], $user['role'],$user['image'], $user['est_valide']);
        return $u;
    }
    
    public function creerRecuperation($cle,$login,$dateHeure){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO recuperation (cle, login, dateHeure)
        values (:cle, :login, :dateHeure)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":cle",$cle,PDO::PARAM_STR);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":dateHeure",$dateHeure,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor(); 
    }
    
    public function getUserByMail($mail){
        $stmt = $this->getBdd()->prepare("SELECT login FROM utilisateur WHERE mail=:mail");
        $stmt->bindValue(":mail",$mail,PDO::PARAM_STR);
        $result = $stmt->execute();
        $login = $stmt->fetch(PDO::FETCH_ASSOC);
        if($login == false){
            throw new Exception("Aucun compte associé au mail : ".$mail);
        }
        $stmt->closeCursor();
        return $login['login'];
    }
    
    public function isMailAllreadyExist($mail){
        $pdo = $this->getBdd();
        $req = "SELECT mail FROM utilisateur WHERE mail=:mail";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":mail",$mail,PDO::PARAM_STR);
        $stmt->execute();
        $mail = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $mail['mail'];
    }
    
    public function getLoginByCle($cle){
        $stmt = $this->getBdd()->prepare("SELECT login FROM recuperation WHERE cle=:cle");
        $stmt->bindValue(":cle",$cle,PDO::PARAM_STR);
        $stmt->execute();
        $loginbd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $loginbd['login'];
    }
    
        public function reinitPasswod($login, $passwdHash) {
        var_dump($login,$passwdHash);
        $stmt = $this->getBdd()->prepare("UPDATE utilisateur SET password=:passwdHash WHERE login=:login");
        $stmt->bindValue(":passwdHash",$passwdHash,PDO::PARAM_STR);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $result = $stmt->execute();
    }
    

}
<?php
require_once "model/UsersDao.class.php";
require_once "outil/Securite.class.php";
require_once "model/InscriptionDao.class.php";
require_once "model/FormationDao.class.php";
require_once "model/RessourceDao.class.php";
require_once "model/SequenceDao.class.php";
require_once "outil/Constante.class.php";

class UserControleur {
    private $userDao;
    private $inscriptionDao;
    private $formationDao;
    private $sequenceDao;
    private $ressourceDao;
    
    public function __construct(){
        $this->userDao = UsersDao::getInstance();
        $this->inscriptionDao = InscriptionDao::getInstance();
        $this->formationDao = FormationDao::getInstance();
        $this->sequenceDao = SequenceDao::getInstance();
        $this->ressourceDao = RessourceDao::getInstance();
    }
    /*function accepterCookie(){
        require "vue/afficherCookieConsent.view.php";
    }*/
    public function creerCompte(){
        $alert = "";
        require "vue/creerCompte.view.php";
    }
    public function creerCompteValidation($login,$mail,$password,$mentions,$perso){
        $alert = "";
        if(!$mentions || !$perso){
            $alert = "Vous devez valider les cases à cocher pour pouvoir créer votre compte étudiant !"; 
            require "vue/creerCompte.view.php";
        }
        else {
                $cle = uniqid();
                $hash = password_hash($password, PASSWORD_DEFAULT);
                echo "hash=".$hash."<br>";
                $user=new User($login, $hash, $mail, "etudiant","profil.png", 1);
                if($this->userDao->createUser($user, $cle)){
                    $this->sendMailUser($login, $mail,$cle);
                    header("Location: ".URL. "login");
                }
                else throw new Exception ("Le compte n'a pu être créé.");
        }
    }
    private function sendMailUser($login,$mail,$cle){
        $urlVerification = Constante::$ADRESSE_APPLICATION."valider-compte-mail/".$login."/".$cle;
        $sujet = "Création du compte CAFOMA";
        $message = "Pour valider votre compte veuillez cliquer sur le lien suivant ".$urlVerification;
        Outils::sendMail($mail,$sujet,$message);
    }
    function recevoirMailCompteValidation($login,$cle){
        $state = $this->userDao->validerCompte($login,$cle);
        if($state == false)
            throw new Exception ("Le lien est incorrecte, votre compte n'est pas validé");
        $alert="";
        require "vue/login.view.php";
    }
    function login(){
        $alert="";
        if(!Securite::verifAccessEtudiant()){
            require "vue/login.view.php";
        }
        else header("Location: ".URL."afficher-profil");
    }
    function validerLoginPasswd($login,$password){
        //echo "validerLoginPasswd login=".$login;
        $alert="";
        if(!$this->userDao->isExistLoginUser($login)){
            throw new Exception("Le login n'existe pas");
        }
        else {          //if(!Securite::verifAccessAdmin()){
            if(isset($login) && !empty($login)
                     && isset($password) && !empty($password))        
            {
                if($this->userDao->isValidUser($login)){
                    //echo "user valide";
                    //echo "password=".$password."<br>";
                    $passwdHashbd = $this->userDao->getPasswdHashUser($login);
                    //echo "passwdHash bd=".$passwdHashbd."<br>";
                    if(password_verify($password, $passwdHashbd)){
                        $_SESSION['login'] = $login;
                        $_SESSION['role'] = $this->userDao->getRoleByLogin($login);
                        header("Location: ".URL."afficher-profil");
                    }
                    else {
                        $alert = "Mot de passe invalide";
                        require "vue/login.view.php";
                    }
                }
                else {
                    $alert = "Vous devez valider votre compte via votre mail";
                    require "vue/login.view.php";
                }
            } else {
                $alert = "Saisir un nom d'utilisateur et un mot de passe";
                require "vue/login.view.php";
            }
        }
    }
    function afficherProfil(){
        if(Securite::isConnected()){ 
            $user = $this->userDao->findUserByLogin($_SESSION['login']); 
            //utils::afficherTableau($user, "user");
            require "vue/afficherProfil.view.php";
        }
        else throw new Exception("Vous n'êtes pas connecté");
    }
    
    public function supprimerSonCompte() {
        if($_SESSION['role'] !== 'administrteur'){
            if($_SESSION['role'] == 'etudiant'){
                $this->userDao->supprimerAllInscriptionBylogin($_SESSION['login']);
                $this->userDao->supprimerCompte($_SESSION['login']);  
                unset($_SESSION['role']);
                unset($_SESSION['nom']);
                header("Location: ".URL."accueil");
            }
            if($_SESSION['role'] == 'partenaire'){
//              $acronymes = $this->formationDao->FindAllAcronymeByLogin($_SESSION['login']);     
//              $this->ressourceDao->supprimerAllRessource($acronyme);
//              $this->sequenceDao->supprimerAllRessource($acronyme);
                
                
                $this->userDao->supprimerAllInscriptionBylogin($_SESSION['login']);
                $this->formationDao->supprimerAllFormationTopartenaire($_SESSION['login']);
                $this->userDao->supprimerCompte($_SESSION['login']);  
                unset($_SESSION['role']);
                unset($_SESSION['nom']);
                header("Location: ".URL."accueil");
            }
        }
        else {
            $alert = "Vous ne pouvez pas supprimer votre compte car vous êtes administrateur";
        }
    }

    function supprimerCompteEtudiant($login){
        if(Securite::isConnected()){ 
            $user = $this->userDao->findUserByLogin($login); 
            if($user->getRole() == 'etudiant' || $user->getRole() == 'partenaire'){
                $this->userDao->supprimerAllInscriptionBylogin($login);
                $state = $this->userDao->supprimerCompte($login);
                header("Location: ".URL."administrer-utilisateur");
            }
            else {
                require "vue/administrerUtilisateur.view.php";
            }
        }
        else throw new Exception("Vous n'êtes pas connecté");
    }
    function logout(){
        if(Securite::isConnected()){
            unset($_SESSION['role']);
            unset($_SESSION['nom']);
            header("Location: index.php");
        }
        else throw new Exception("Vous n'êtes pas connecté, vous ne pouvez vous délogger");
    }
    function administrerUtilisateur(){
        if(Securite::verifAccessAdmin()){
            $users = $this->userDao->findAllUser();
            //Outils::afficherTableau($users, "users");
            require "vue/administrerUtilisateur.view.php";
        }
        else throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
    function supprimerUser($login){
        if(Securite::verifAccessAdmin()){
            if(!$this->empruntDao->isExistEmpruntByLogin($login)){
                $this->userDao->supprimerUser($login);
                header("Location: index.php?action=administrer-utilisateur");
            }
            else {
                throw new Exception("Impossible de supprimer ce compte car des formations y font référence");
            }
        }
        else throw new Exception("Vous n'avez pas le droit d'accéder à cette page");
    }
    
    function CreerComptePartenaire(){
        if(Securite::verifAccessAdmin()){
            $alert = "";
            require "vue/creerComptePartenaire.view.php";
        }
    }
    
    function CreerComptePartenaireValidation($login, $mail, $password){
        if(Securite::verifAccessAdmin()){ 
            $alert = "";
            $cle = uniqid();
            $hash = password_hash($password, PASSWORD_DEFAULT);
            echo "hash=".$hash."<br>";
            $user=new User($login, $hash, $mail, "partenaire","profil.png", 1);
            $this->userDao->createUser($user, $cle);
            header("Location: ".URL. "administrer-utilisateur");
        }
        else throw new Exception("Vous n'avez pas les droit nécessaires"); 
    }
    
    function RecupererMdp(){
        $alert = "";
        require "vue/recupererMdp.view.php";
    }
    
    // Fonction permettant de transmettre les infos et rediriger l'utilsateur vers la page d'accueil
    function RecupererMdpValidation($login,$mail,$cle){
        $this->sendMailRecupMdp($login,$mail,$cle);
        header("Location: ".URL. "accueil");
    }
    
    // Fonction permettant de l'envoie du mail, et de la redirection vers la page des questions
    private function sendMailRecupMdp($login,$mail,$cle){
        $urlVerification = Constante::$ADRESSE_APPLICATION."recuperationMdp/".$login."/".$cle;
        $sujet = "Récupération de votre mot de passe";
        $message = "Pour récupérer votre compte veuillez cliquer sur le lien suivant ".$urlVerification;
    }
    
    
}
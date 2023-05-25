<?php
require_once "model/FormationDao.class.php"; 
require_once "model/InscriptionDao.class.php";
require_once "model/RessourceDao.class.php";
require_once "model/SequenceDao.class.php";
require_once "model/UsersDao.class.php";
require_once "outil/Outils.class.php";
require_once "outil/Constante.class.php";
require_once "model/Formation.class.php"; 
require_once "model/Ressource.class.php";
require_once "model/Sequence.class.php";
require_once "model/User.class.php";

class FormationControleur {
    private $formationDao;
    private $inscriptionDao;
    private $ressourceDao;
    private $sequenceDao;
    private $userDao;


    public function __construct(){
        $this->formationDao = FormationDao::getInstance();
        $this->inscriptionDao = InscriptionDao::getInstance();
        $this->ressourceDao = RessourceDao::getInstance();
        $this->sequenceDao = SequenceDao::getInstance();
        $this->userDao = UsersDao::getInstance();
    }    
    
    // Récupération de 5 formations pour les afficher en page d'accueil
    public function AffichageFormationAccueil(){
        $alert = "";
        $formations = $this->formationDao->findFiveFormation();
        require "vue/accueil.view.php";
    }
    
    
    // Récupération et affichage du catalogue entier
    public function afficherCatalogue(){
        $alert = "";
        $formations = $this->formationDao->findAllFormation();
        require "vue/afficherCatalogue.view.php";
    }
    
    // Récupération et affichage d'une seule formation sans les ressources
    public function afficherFormation($acronyme){
        $formation = $this->formationDao->findOneFormationByAcronyme($acronyme); 
        require "vue/afficherFormation.view.php";
    }
    
    // Récupération et affichage du détail d'une formation avce les séquences et ressource
     public function afficherFormationWithRessource($acronyme){
        if(Securite::isConnected()){ 
            $formation = $this->formationDao->findOneFormationWithRessourceByAcronyme($acronyme);
            require "vue/afficherFormationWithRessource.view.php";
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
   
    // Création d'une formation
    public function creerFormation() {
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){
            require "vue/creerFormation.view.php";
        }
        else throw new Exception("Vous n'avez pas le droits d'accéder à cette page");
    } 
    
    // Fonction de validation de la création d'une formation
    public function creerFormationValidation($acronyme,$titre,$description,$pour_qui,$prerequis){
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){
            $file = $_FILES['image'];
            $repertoire = "public/img/";
            $imageAjoute = Outils::ajouterImage($file,$repertoire);
            $file = $_FILES['video'];
            echo "video=".$file['name'];
            $repertoire = "public/img/";
            $videoAjoute = Outils::ajouterImage($file,$repertoire);
            $this->formationDao->creerFormation($acronyme,$titre,$description,$imageAjoute,$videoAjoute,$_SESSION['login'],$pour_qui, $prerequis);
            header("Location: ".URL."gerer-formation");
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires");
    }
    
    // Récupération et suppression d'une formation
    function supprimerFormation($acronyme){ 
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){          
                $nomImage = $this->formationDao->findOneFormationByAcronyme($acronyme)->getImage();
                $this->ressourceDao->supprimerAllRessource($acronyme);
                $this->sequenceDao->supprimerAllSequence($acronyme);
                $this->formationDao->supprimerFormation($acronyme);
                //unlink("public/img/".$nomImage);
                if(Securite::verifAccessPartenaire()) {
                   header("Location: ".URL."gerer-formation"); 
                }
                 if(Securite::verifAccessAdmin()) {
                   header("Location: ".URL."administrer-formation"); 
                }
            }    
        else throw new Exception("Vous n'avez pas les droits nécessaires");
    }
    
    // Fonction permettant de s'inscrire à une formation
    public function inscrireFormation($acronyme){
        if(Securite::isConnected()){ 
            $this->inscriptionDao->creerInscription($_SESSION['login'],$acronyme,date('Y-m-d H:i:s'));
            header("Location: ".URL."afficher-ses-inscription");
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
    
    // Fonction permettant de se désinscrire à une formation
    public function desinscrireFormation($acronyme){
        if(Securite::isConnected()){ 
            $this->inscriptionDao->supprimerInscription($_SESSION['login'],$acronyme);
            header("Location: ".URL."afficher-ses-inscription");
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
    
    // Fonction permettant d'afficher toutes les formations auquel un utilisateur est inscrit
    public function afficherSesInscription() {
        if(Securite::isConnected()){ 
            $alert = "";
            $formations = $this->formationDao->listerFormationByLoginEtudiant($_SESSION['login']);
            if($formations == null){
               $alert = "Vous êtes inscrit a aucune formation";
            }
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
        
        require "vue/afficher-ses-formation.view.php";
        
    }
   
    // Fonction permettant de récupérer toute les formations et de les afficher afin de les administrer
    public function adminstrerFormation(){
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){ 
            $alert="";
            $formationList=$this->formationDao->findAllFormation();
            if(!isset($formationList) || empty($formationList)){
                $alert="Vous n'avez pas créé de formation"; 
            }
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
        
        require "vue/administrerFormations.view.php";
    }
    
    // Fonction permettant de renseigner une formation
    function RenseignerFormation($acronyme){
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){
            $alert = "";
            $formation = $this->formationDao->findOneFormationWithRessourceByAcronyme($acronyme);
            require "vue/renseignerFormation.view.php";
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
    
    // Fonction permettant de valider le fait de renseigner une formation
    function RenseignerFormationValidation($acronyme,$intitule_sequence,$intitule,$type_document){
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){
            $alert = "";
            $numero_sequence = $this->sequenceDao->findNumSequenceWithIntitule($intitule_sequence,$acronyme); // C'est ok
            $numero_ressource = $this->ressourceDao->FindNbMaxRessourceForSequence($acronyme,$numero_sequence); // C'est ok     
            $file = $_FILES['document'];
            $repertoire = "./public/ressource/";
            $ressourceAjoute = Outils::ajouterImage($file,$repertoire);     
            $ressource = $this->ressourceDao->renseignerFormationByAcronyme($acronyme, $numero_sequence, $numero_ressource, $intitule ,$type_document, $ressourceAjoute);
            header("Location: ".URL."gerer-formation"); 
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
    
    // Fonction permettant de récupérer toutes les formations créér par un partenaire
    function gererFormation(){
        if(Securite::verifAccessPartenaire()){
            $alert = "";
            $formations = $this->formationDao->findAllFormationByPartenaire($_SESSION['login']); 
            if($formations == null){
                $alert = "Vous n'avez pas créé de formation";
            }
            require "vue/afficherFormationByFormateur.view.php";
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
     
//    function CertificationByFormation($acronyme){
//        $alert = "";
//        $questions = $this->formationDao->getAllQuestionToFormationByAcronyme($acronyme);
//        require "vue/questionToCertifUser.php";
//    }
    
    
    // Fonction permettant de lire les vidéo d'une ressource
    function LireVideoRessource($acronyme,$numero_sequence,$numero_ressource){
        if(Securite::isConnected()){ 
            $alert = "";
            $ressource = $this->ressourceDao->FindOneDocument($acronyme,$numero_sequence,$numero_ressource);
            require 'vue/afficherVideo.view.php';
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
    

} // FIN FormationControleur.class.php
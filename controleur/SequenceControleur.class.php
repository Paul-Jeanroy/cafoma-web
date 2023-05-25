<?php
require_once "model/FormationDao.class.php"; 
require_once "model/InscriptionDao.class.php";
require_once "model/RessourceDao.class.php";
require_once "outil/Outils.class.php";
require_once "outil/Constante.class.php";
require_once "model/Formation.class.php"; 
require_once "model/Ressource.class.php";
require_once "model/Sequence.class.php";

class SequenceControleur {
    private $formationDao;
    private $inscriptionDao;
    private $ressourceDao;
    private $sequenceDao;
    
    public function __construct(){
        $this->formationDao = FormationDao::getInstance();
        $this->inscriptionDao = InscriptionDao::getInstance();
        $this->ressourceDao = RessourceDao::getInstance();
        $this->sequenceDao = SequenceDao::getInstance();
    }    

    // Fonction permettant de créer une séquence
    function CreerSequence($acronyme){
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){ 
            $formations = $this->formationDao->findOneFormationByAcronyme($acronyme); 
            require "vue/creerSequence.php";
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires");
    }
    
    // Fonction permettant de valider le fait de créer une séquence
    function CreerSequenceValidation($acronyme, $intitule, $description){
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){ 
            $numero_sequence = $this->sequenceDao->FindNbMaxSequence($acronyme);
            $sequence = $this->sequenceDao->CreerSequenceForFormation($acronyme, $numero_sequence, $intitule, $description);
            header("Location: ".URL."renseigner-formation/$acronyme"); 
        }
        else throw new Exception("Vous n'avez pas les droits nécessaires"); 
    }
    
    // Fonction permettant la suppression d'une séquence
    function SupprimerSequence($acronyme, $intitule){
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){ 
                $this->ressourceDao->supprimerRessource($acronyme, $intitule);
                $this->sequenceDao->supprimerSequence($acronyme, $intitule);
                header("Location: ".URL."afficher-formation-ressource/$acronyme"); 
            }    
        else throw new Exception("Vous n'avez pas les droits nécessaires");  
    }
    
    function ModifierNomSequence($acronyme, $numero_sequence){
        $alert = "";
        $sequence = $this->sequenceDao->FindOneSequence($acronyme, $numero_sequence);
        require "vue/modifierNomSequence.php";
    }
    
    function ModifierNomSequenceValidation($acronyme, $numero_sequence, $intitule){
        var_dump($acronyme, $numero_sequence, $intitule);
        if($intitule !== ""){
            $alert = "";
            $this->sequenceDao->ModifierNomSequence($intitule, $acronyme, $numero_sequence);
        }
        else {
            $alert = "Veuillez mettre un nom de séquence valide !";
        }
        //header("Location:".URL."afficher-formation-ressource/$acronyme");
    } 
    
} // Fin SequenceControleur.class.php
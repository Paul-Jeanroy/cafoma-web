<?php
require_once "model/FormationDao.class.php"; 
require_once "model/InscriptionDao.class.php";
require_once "model/RessourceDao.class.php";
require_once "outil/Outils.class.php";
require_once "outil/Constante.class.php";
require_once "model/Formation.class.php"; 
require_once "model/Ressource.class.php";

class RessourceControleur {
    private $formationDao;
    private $inscriptionDao;
    private $ressourceDao;
    
    public function __construct(){
        $this->formationDao = FormationDao::getInstance();
        $this->inscriptionDao = InscriptionDao::getInstance();
        $this->ressourceDao = RessourceDao::getInstance();
    }    

    // Fonction permettant de supprimer une ressource dans une séquence
    function SupprimerRessource($acronyme, $numero_sequence, $numero_ressource) {
        if(Securite::verifAccessAdmin() || Securite::verifAccessPartenaire()){ 
                $tabDocument = $this->ressourceDao->FindOneDocumentToDelete($acronyme,$numero_sequence,$numero_ressource);
                $this->ressourceDao->supprimerRessourceBDD($acronyme, $numero_sequence, $numero_ressource);
                foreach($tabDocument as $document){
                    //unlink("public/ressource/".$document);
                }
                
                //header("Location: ".URL."afficher-formation-ressource/$acronyme"); 
            }    
            else throw new Exception("Vous n'avez pas les droits nécessaires");  
    }
    
    
} // Fin RessourceControleur.class.php
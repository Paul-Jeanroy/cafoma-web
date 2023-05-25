<?php
require_once "Connexion.class.php";
require_once "Ressource.class.php";
require_once "./outil/Outils.class.php";

class RessourceDao extends Connexion {
    private static $_instance = null;

    private function __construct() {}
    
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new RessourceDao();  
        }
        return self::$_instance;
    } 
    
    // Renseigner une formation par son auteur
    function renseignerFormationByAcronyme($acronyme,$numero_sequence,$numero_ressource,$intitule,$type_document, $ressourceAjoute){
        $pdo = $this->getBdd();
        $req = "INSERT INTO ressources(acronyme, numero_sequence, numero_ressource, intitule, type_document, document)
                VALUES (:acronyme , :numero_sequence , :numero_ressource, :intitule, :type_document, :document)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $stmt->bindValue(":numero_ressource",$numero_ressource,PDO::PARAM_INT);
        $stmt->bindValue(":intitule",$intitule,PDO::PARAM_STR);
        $stmt->bindValue(":type_document",$type_document,PDO::PARAM_STR);
        $stmt->bindValue(":document",$ressourceAjoute,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }
    
    // Supprimer une ressource d'une formation
    function supprimerRessourceBDD($acronyme, $numero_sequence, $numero_ressource){
        $pdo = $this->getBdd();
        $req = "DELETE FROM ressources WHERE acronyme=:acronyme AND numero_ressource=:numero_ressource AND numero_sequence=:numero_sequence";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_ressource",$numero_ressource,PDO::PARAM_INT);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            return true;
        }
        else {
            return false;
        }
    }
    
    // Supprimer une ressource d'une formation
    function supprimerAllRessource($acronyme){
        $pdo = $this->getBdd();
        $req = "DELETE FROM ressources WHERE acronyme = :acronyme";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

    }
    
    function FindNbMaxRessourceForSequence($acronyme, $numero_sequence){    
        $stmt = $this->getBdd()->prepare("SELECT MAX(numero_ressource) FROM ressources WHERE acronyme = :acronyme AND numero_sequence = :numero_sequence");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $cpt = $stmt->execute();
        $NbressourceBdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        foreach($NbressourceBdd as $numero_ressource) {
            if($numero_ressource == null)
                $numero_ressource = "1";
            else 
                $numero_ressource = $numero_ressource + 1;
        }
        return $numero_ressource;
    }
    
    function FindNbRessourceToSuppr($acronyme,$intitule){
        $stmt = $this->getBdd()->prepare("SELECT numero_ressource FROM ressources WHERE acronyme = :acronyme AND intitule = :intitule");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":intitule",$intitule,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $numero_ressource = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        return $numero_ressource;
    }
    
    function FindOneDocument($acronyme,$numero_sequence,$numero_ressource){
        $stmt = $this->getBdd()->prepare(
                "SELECT * FROM ressources "
                . "WHERE acronyme = :acronyme "
                . "AND numero_sequence = :numero_sequence "
                . "AND numero_ressource = :numero_ressource");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $stmt->bindValue(":numero_ressource",$numero_ressource,PDO::PARAM_INT);
        $cpt = $stmt->execute();
        $ressourcebdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        $ressource = new Ressource($ressourcebdd["intitule"],$ressourcebdd["numero_ressource"],
                $ressourcebdd["type_document"],$ressourcebdd["document"]);
        return $ressource;
    }
    
        function FindOneDocumentToDelete($acronyme,$numero_sequence,$numero_ressource){
        $stmt = $this->getBdd()->prepare(
                "SELECT document FROM ressources "
                . "WHERE acronyme = :acronyme "
                . "AND numero_sequence = :numero_sequence "
                . "AND numero_ressource = :numero_ressource");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $stmt->bindValue(":numero_ressource",$numero_ressource,PDO::PARAM_INT);
        $cpt = $stmt->execute();
        $document = $stmt->fetch(PDO::FETCH_ASSOC);
        return $document;
    }
}

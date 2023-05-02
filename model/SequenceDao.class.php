<?php
require_once "Connexion.class.php";
require_once "Sequence.class.php";
require_once "./outil/Outils.class.php";

class SequenceDao extends Connexion {
    private static $_instance = null;

    private function __construct() {}
    
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new SequenceDao();  
        }
        return self::$_instance;
    }
    
    function FindNbMaxSequence($acronyme){
        $stmt = $this->getBdd()->prepare("SELECT MAX(numero_sequence) FROM sequence WHERE acronyme = :acronyme");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $NbsequenceBdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        foreach($NbsequenceBdd as $numero_sequence) {
            if($numero_sequence == null)
                $numero_sequence = "1";
            else 
                $numero_sequence = $numero_sequence + 1;
        }
        return $numero_sequence;
    }
    
    function CreerSequenceForFormation($acronyme, $numero_sequence,$intitule, $description){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO sequence (acronyme, numero_sequence, intitule, description)
        values (:acronyme, :numero_sequence, :intitule, :description)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $stmt->bindValue(":intitule",$intitule,PDO::PARAM_STR);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        echo "resultat=".$resultat;
    }
    
    function findNumSequenceWithIntitule($intitule, $acronyme){
        $stmt = $this->getBdd()->prepare("SELECT numero_sequence FROM sequence WHERE intitule = :intitule AND acronyme = :acronyme");
        $stmt->bindValue(":intitule",$intitule,PDO::PARAM_STR);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->execute();
        $numero_sequencebdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $cpt = $stmt->execute();
        $stmt->closeCursor(); 
        foreach($numero_sequencebdd as $numero_sequence) {
            if($numero_sequence == null)
                $numero_sequence = "1";
            else 
                $numero_sequence;
        }
        return $numero_sequence;
    }
    
    
//    function FindSequenceForRessource($acronyme, $numeroRessource){
//        $stmt = $this->getBdd()->prepare("SELECT intitule FROM sequence WHERE acronyme=:acronyme");
//        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
//        $cpt = $stmt->execute();
//        $sequenceBdd = $stmt->fetch(PDO::FETCH_ASSOC);
//        $stmt->closeCursor(); 
//        $sequence = null;
//        if(isset($sequenceBdd) && !empty($sequenceBdd))
//            $sequence=new Sequence($sequenceBdd['intitule']);
//        return $sequence;
//    }
    
    // Supprimer une sequence d'une formation
    function supprimerSequence($acronyme, $intitule){
        $pdo = $this->getBdd();
        $req = "DELETE FROM sequence WHERE acronyme = :acronyme AND intitule = :intitule";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":intitule",$intitule,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }
    
        // Supprimer une sequence d'une formation
    function supprimerAllSequence($acronyme){
        $pdo = $this->getBdd();
        $req = "DELETE FROM sequence WHERE acronyme = :acronyme";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }
    
    function FindOneSequence($acronyme, $numero_sequence){
        $stmt = $this->getBdd()->prepare("SELECT * FROM sequence WHERE acronyme = :acronyme AND numero_sequence = :numero_sequence");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $stmt->execute();
        $sequencebdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->execute();
        $stmt->closeCursor(); 
        $sequence = new Sequence($sequencebdd['acronyme'],$sequencebdd["intitule"], $sequencebdd["description"],$sequencebdd["numero_sequence"]);
        return $sequence;
    }
    
    function ModifierNomSequence($acronyme, $numero_sequence, $intitule, $description){
        $pdo = $this->getBdd();
        $req = "UPTADE sequence "
                . "SET intitule = :intitule"
                . "WHERE acronyme = :acronyme "
                . "AND numero_sequence = :numero_sequence ";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":numero_sequence",$numero_sequence,PDO::PARAM_INT);
        $stmt->bindValue(":intitule",$intitule,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
    }
     
}
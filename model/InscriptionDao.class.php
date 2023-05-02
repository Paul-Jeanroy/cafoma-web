<?php
require_once "Connexion.class.php";
require_once "Inscription.class.php";
require_once "./outil/Outils.class.php";

class InscriptionDao extends Connexion {
    private static $_instance = null;

    private function __construct() {}
    
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new InscriptionDao();  
        }
        return self::$_instance;
    } 
    public function creerInscription($login,$acronyme,$dateInscription){
        $pdo = $this->getBdd();
        $req = "
            INSERT INTO utilisateur_formation_inscrire (login, acronyme, date_inscription)
            VALUES (:login, :acronyme, :date_inscription)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":date_inscription",$dateInscription,PDO::PARAM_STR);
        $nb = $stmt->execute();
        $stmt->closeCursor();      
        if($nb > 0){
            return $pdo->lastInsertId();
        }
        return false;
    }
    
    public function findAllInscriptionByLogin($login) {
        //echo "findAllInscriptionByLogin login=".$login;
        
        $stmt = $this->getBdd()->prepare(
            "SELECT ufi.login, ufi.acronyme, ufi.date_inscription, f.titre "
                . " FROM utilisateur_formation_inscrire AS ufi"
                . " JOIN formation AS f ON ufi.acronyme = f.acronyme "
                . "WHERE login= :login ORDER BY date_inscription ASC");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $nb = $stmt->execute();
        $inscriptionListBd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $inscriptionList = array();
        foreach($inscriptionListBd as $inscriptionBd){
            $inscription = new Inscription($inscriptionBd['acronyme'],$inscriptionBd['date_inscription'],$inscriptionBd['titre']);
            $inscriptionList[]=$inscription;
        }
        return $inscriptionList;         
    }
    public function isInscriptionByFormationAcronyme($acronyme){
        echo "nbrInscriptionByFormationAcronyme acronyme=".$acronyme."<br>";
        //$requete = "SELECT count(*) AS nb FROM utilisateur_formation_inscrire WHERE acronyme = '".$acronyme."'<br>";
       
        $stmt = $this->getBdd()->prepare(
            "SELECT count(acronyme) AS nb FROM utilisateur_formation_inscrire WHERE acronyme = :acronyme"
            );
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->execute();
        $nbFormationInscription = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        echo "nbrInscriptionByFormationAcronyme nbFormationInscription=".$nbFormationInscription['nb'];
        return ($nbFormationInscription['nb'] > 0);
    }
    public function nbEtudiantByAcronymeInscrireFormation($login){
        $stmt = $this->getBdd()->prepare(
            "SELECT count(acronyme) AS nb FROM utilisateur_formation_inscrire WHERE login = :login");
        $stmt->bindValue(":login",$login,PDO::PARAM_INT);
        $stmt->execute();
        $nbFormationInscription = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        echo "nbEtudiantByAcronymeInscrireFormation nbFormationEtudiantInscrire=".$nbFormationInscription['nb'];
        return $nbFormationInscription['nb'];
    }
    
    public function supprimerInscription($login,$acronyme) {
        $req = "DELETE FROM utilisateur_formation_inscrire WHERE login = :login AND acronyme = :acronyme";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $nb = $stmt->execute();
        if($nb > 0){
            echo "inscription supprimer acronyme=".$acronyme."<br>";
        }
        
    }
    public function findInscriptionTabAcroByLogin($login) {
        $stmt = $this->getBdd()->prepare(
            "SELECT acronyme "
                . " FROM utilisateur_formation_inscrire"
                . " WHERE login= :login");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $nb = $stmt->execute();
        $acronymeListBd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        //Outils::afficherTableau($acronymeListBd, "acronymeListBd");
        $acronymeList = array();
        foreach($acronymeListBd as $acronymeBd){
            //$inscription = new Inscription($inscriptionBd['acronyme'],$inscriptionBd['date_inscription'],$inscriptionBd['titre']);
            //echo "LivreDao - findAllLivre - l=".$l." livre[idLivre]=".$livre['idLivre']."<br>";
            $acronymeList[]=$acronymeBd['acronyme'];
        }
        //Outils::afficherTableau::afficherListObjet($empruntList, "empruntList");
        //Outils::afficherTableau($inscriptionList, "inscriptionList");
        return $acronymeList;         
    }
    public function nbUserInscriptionByAcronyme($acronyme) {
        $stmt = $this->getBdd()->prepare(
            "SELECT COUNT(acronyme) AS nb "
                . " FROM utilisateur_formation_inscrire"
                . " WHERE acronyme= :acronyme");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $nb = $stmt->execute();        
        $nbUserInscriptionBdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        return ($nbUserInscriptionBdd['nb'] > 0);
    }
    
    function isExistInscriptionByLogin($login){
        $stmt = $this->getBdd()->prepare(
        "SELECT count(login) AS nb FROM utilisateur_formation_inscrire WHERE login = :login");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $nbInscription = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        return ($nbInscription['nb'] > 0);
    }
    
    public function supprimerAllInscription($login) {
        $req = "DELETE FROM utilisateur_formation_inscrire WHERE login =:login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $resultat = $stmt->execute();
    }
   
}

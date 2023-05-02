<?php
require_once "Connexion.class.php";
require_once "Formation.class.php";
require_once "Inscription.class.php";
require_once "Ressource.class.php";
require_once "Sequence.class.php";

//require_once "outil/Outils.class.php";

class FormationDao extends Connexion {
    private static $_instance = null;

    private function __construct() {}
    
    public static function getInstance() {
        if(is_null(self::$_instance)) {
            self::$_instance = new FormationDao();  
        }
        return self::$_instance;
    } 
    
    // Créer une formation
    function creerFormation($acronyme,$titre,$description,$image,$video,$loginCreateur,$pour_qui,$prerequis){
        $pdo = $this->getBdd();
        $req = "
        INSERT INTO formation (acronyme, titre, description, image, video, login_createur, pour_qui, prerequis)
        values (:acronyme, :titre, :description , :image, :video, :login_createur, :pour_qui, :prerequis)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindValue(":description",$description,PDO::PARAM_STR);
        $stmt->bindValue(":image",$image,PDO::PARAM_STR);
        $stmt->bindValue(":video",$video,PDO::PARAM_STR);
        $stmt->bindValue(":login_createur",$loginCreateur,PDO::PARAM_STR);
        $stmt->bindValue(":pour_qui",$pour_qui,PDO::PARAM_STR);
        $stmt->bindValue(":prerequis",$prerequis,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        echo "resultat=".$resultat;    
    }
    
    
    // Supprimer une formation
    function supprimerFormation($acronyme){
        $pdo = $this->getBdd();
        $req = "DELETE FROM formation WHERE acronyme = :acronyme";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();
        if($resultat > 0){
            return true;
        }
        else {
            return false;
        }
    }

    // Récupère toutes les formations (sans les ressources)
    public function findAllFormation(){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formation");
        $stmt->execute();
        $bddFormations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $formations = null;
        foreach($bddFormations as $f){
            $formation=new Formation($f['acronyme'], $f['titre'], $f['description'], $f['image'], $f['video'], $f['pour_qui'],
                    $f['prerequis']);
            $formations[]=$formation;
        }
        return $formations;
    }
    
    // Fonction permettant de récupérer une seule formation avec ses ressources grâce à son acronyme
    public function findOneFormationWithRessourceByAcronyme($acronyme){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formation WHERE acronyme=:acronyme");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $formationBdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        $formation=new Formation($formationBdd['acronyme'], $formationBdd['titre'], $formationBdd['description'], $formationBdd['image'], 
              $formationBdd['video'],$formationBdd['pour_qui'],$formationBdd['prerequis']);
        $formation->setSequenceList($this->FindAllSequenceForFormation($acronyme));
        return $formation;
    }
    
        // Récupère toutes les formations selon acronyme
    function FindAllRessourceByFormation($num_sequence, $acronyme){
        $stmt = $this->getBdd()->prepare("SELECT * FROM ressources WHERE acronyme=:acronyme AND numero_sequence = :numero_sequence");
        $stmt->bindValue(":numero_sequence",$num_sequence,PDO::PARAM_STR);
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $ressourceListBdd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor(); 
        $ressources = null;
        if(isset($ressourceListBdd)&&!empty($ressourceListBdd))
        foreach($ressourceListBdd as $r){
            $ressource = new Ressource($r['intitule'], $r["numero_ressource"],$r["type_document"],$r['document']);
            $ressources[]=$ressource;
        }
        return $ressources;
    }
    
    function FindAllSequenceForFormation($acronyme){
        $stmt = $this->getBdd()->prepare("SELECT * FROM sequence WHERE acronyme=:acronyme");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->execute();
        $bddSequences = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $sequences = null;
        foreach($bddSequences as $s){
            $sequence=new Sequence($s['acronyme'],$s['intitule'],$s['description'],$s['numero_sequence']);
            $sequence->setRessourceList($this->FindAllRessourceByFormation($sequence->getNumSequence(), $acronyme));
            $sequences[]=$sequence;
        }
        return $sequences;
    }
    
    // Récupère toutes les formations qu'un partenaire à créées
    public function findAllFormationByPartenaire($login){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formation WHERE login_createur=:login");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $bddFormations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $formations = null;
        foreach($bddFormations as $f){
            $formation=new Formation($f['acronyme'], $f['titre'], $f['image'], $f['description'], $f['login_createur'],$f['video'],
                    $f['pour_qui'],$f['prerequis']);
            $formations[]=$formation;
        }
        return $formations;
    }
    // Fonction permettant de récupérer une seule formation avec son acronyme
    public function findOneFormationByAcronyme($acronyme){
        $stmt = $this->getBdd()->prepare("SELECT * FROM formation WHERE acronyme=:acronyme");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $cpt = $stmt->execute();
        $formationBdd = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        $formation=new Formation($formationBdd['acronyme'], $formationBdd['titre'], $formationBdd['description'], $formationBdd['image'], 
              $formationBdd['video'],$formationBdd['pour_qui'],$formationBdd['prerequis']);
        return $formation;
    }
    
    // Fonction permettant de supprimer les formation d'un partenaire lorsque son compte est supprimé
    public function supprimerAllFormationTopartenaire($login){
        $stmt = $this->getBdd()->prepare("DELETE FROM formation WHERE login_createur=:login");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $formation = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();  
        return $formation;
    }
    
    // Fonction permettant de recupérer toute les formations auquel un eleve est inscrit
    public function listerFormationByLoginEtudiant($login) {
        $stmt = $this->getBdd()->prepare(
                  "SELECT f.acronyme, f.titre, f.image, f.video, f.login_createur, f.description, f.pour_qui, f.prerequis "
                . "FROM formation AS f "
                . "WHERE  f.acronyme IN ("
                . "     SELECT ufi.acronyme "               
                . "     FROM utilisateur_formation_inscrire AS ufi "
                . "     WHERE ufi.login=:login)");
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $stmt->execute();
        $bddFormations = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $formations = null;
        foreach($bddFormations as $f){
            $formation=new Formation($f['acronyme'], $f['titre'], $f['description'], $f['image'], $f['video'], $f['login_createur'],
                $f['pour_qui'],$f['prerequis']);
            $formations[]=$formation;
        }
        return $formations;
        
    }
    
    // Fonction de récupération de toute les questions appartenant à une formation
    function getAllQuestionToFormationByAcronyme($acronyme){
        $stmt = $this->getBdd()->prepare("SELECT question,idQuestion,ReponseQuestion FROM question WHERE acronyme= :acronyme ");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->execute();
        $questionBdd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $questions = null;
        foreach($questionBdd as $q){
        $question=new Question($q['idQuestion'], $q['question'], $q['ReponseQuestion']);
            $question->setReponseList($this->FindAllReponseToQuestionByIdQuestion($question->getIdQuestion(), $acronyme));
            $questions[]=$question;
        }
        return $questions;
    }
    
    // Fonction de récupération de toute les réponses appartenant à une question
    function FindAllReponseToQuestionByIdQuestion($idQuestion, $acronyme){
        $stmt = $this->getBdd()->prepare("SELECT reponse FROM reponse WHERE idQuestion = :idQuestion AND acronyme= :acronyme ");
        $stmt->bindValue(":acronyme",$acronyme,PDO::PARAM_STR);
        $stmt->bindValue(":idQuestion",$idQuestion,PDO::PARAM_INT);
        $stmt->execute();
        $reponseBdd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        $reponses = null;
        foreach($reponseBdd as $r){
            $reponse=new Reponse($r['reponse']);
            $reponses[]=$reponse;
        }
        
        return $reponses;
    }
    
    
    function FindAllAcronymeByLogin($login){
        $pdo = $this->getBdd();
        $req = "SELECT acronyme FROM formation WHERE login_createur = :login";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":login",$login,PDO::PARAM_STR);
        $acronyme = $stmt->execute();
        $reponseBdd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reponseBdd;
    }
}

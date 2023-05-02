<?php
require_once "./model/FormationDao.class.php"; 

$formationDao = FormationDao::getInstance();

if(isset($_GET["operation"])){
    if($_GET["operation"]=="lister"){
        try{
            $formation = $formationDao->findAllFormation();
            print("lister#");
            print(json_encode($formation));
        }catch(PDOException $e){
            print "erreur#".$e->getMessage();
        }
    }
    
}

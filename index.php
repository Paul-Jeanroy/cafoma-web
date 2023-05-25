<?php
require_once "outil/Outils.class.php";
require_once "outil/Securite.class.php";
require_once "controleur/UserControleur.class.php";
require_once "controleur/FormationControleur.class.php";
require_once "controleur/RessourceControleur.class.php";
require_once "controleur/SequenceControleur.class.php";
//echo "Test - session_start";

if (Securite::autoriserCookie()){
    session_start();  
}

//session_start();

$userControleur = new UserControleur();
$formationControleur = new FormationControleur(); 
$ressourceControleur = new RessourceControleur();
$sequenceControleur = new SequenceControleur();

//Outils::afficherTableau($_SESSION,"SESSION");
//Outils::afficherTableau($_POST,"POST");
try{
    
    define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http")."://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
    if(empty($_GET['action']) || !isset($_GET['action'])){
       $formationControleur->AffichageFormationAccueil();
    }
    else {
        $url = explode("/", filter_var($_GET['action']),FILTER_SANITIZE_URL);
        //Outils::afficherTableau($url, "url = ");
        switch ($url[0]){
            case "accueil": $formationControleur->AffichageFormationAccueil();
            break;
        
            /* ------ UTILISATEUR ------ */
            case "creer-compte": $userControleur->creerCompte();
            break;
            case "creer-compte-validation": $userControleur->creerCompteValidation(Securite::validerInputData($_POST['login']), 
                Securite::validerInputData($_POST['mail']),Securite::validerInputData($_POST['passwd']),isset($_POST['mentions']),isset($_POST['perso']));
            break;
            case "valider-compte-mail": $userControleur->recevoirMailCompteValidation($url[1],Securite::validerInputData($url[2]));
            break;
            case "recuperer-passwd" : $userControleur->recupererPassWd($url[1]);
            break;
            case "reinit-passwd": $login=$_POST['login'];$passwd1=$_POST['passwd1'];$passwd2=$_POST['passwd2'];
                $userControleur->reinitialiserPassword($login, $passwd1, $passwd2);
            break;
            case "login": $userControleur->login();
            break;
            case "valider-login": $userControleur->validerLoginPasswd(Securite::validerInputData($_POST['login']),Securite::validerInputData($_POST['password']));
            break;
            case "afficher-profil": $userControleur->afficherProfil();
            break;
            case "logout":  $userControleur->logout();
            break;
            case "modifier-image-compte": $userControleur->modifierImageProfil();
            break;
            case "supprimer-son-compte": $userControleur->supprimerSonCompte();
            break;
            case "envoyer-msg-contact": $userControleur->EnvoyerMailContact(Securite::validerInputData($_POST['mail']),Securite::validerInputData($_POST['sujet']),
                    Securite::validerInputData($_POST['contenu']));
            break;
           
        
            /* ------ FORMATION ------ */
            case "afficher-catalogue": $formationControleur->afficherCatalogue();
            break;
            case "afficher-formation": $formationControleur->afficherFormation($url[1]);
            break;
            case "afficher-formation-ressource": $formationControleur->afficherFormationWithRessource($url[1]);
            break;
            case "inscrire-formation": $formationControleur->inscrireFormation($url[1]);
            break;
            case "afficher-ses-inscription": $formationControleur->afficherSesInscription();
            break;
            case "desinscrire-formation": $formationControleur->desinscrireFormation($url[1]);
            break;
            case "passer-certification" : $formationControleur->CertificationByFormation($url[1]);
            break; 
            case "afficher-ressource": $formationControleur->LireVideoRessource($url[1],$url[2],$url[3]);
            break;
            case "supprimer-sequence": $sequenceControleur->SupprimerSequence($url[1],$url[2]);
            break;
            case "modifier-nom-sequence": $sequenceControleur->ModifierNomSequence($url[1],$url[2]);
            break;
            case "modifier-nom-sequence-validation": $sequenceControleur->ModifierNomSequenceValidation($url[1],$url[2], Securite::validerInputData($_POST['intitule']));
            break;
        
            /* ------ ADMINISTRATIF ------ */
            case "administratif": require "vue/administratif.view.php";
            break;
            case "administrer-utilisateur": $userControleur->administrerUtilisateur();
            break;
            case "supprimer-utilisateur": $userControleur->supprimerCompteEtudiant($url[1]);
            break;
            case "administrer-formation": $formationControleur->adminstrerFormation();
            break;
            case "supprimer-formation": $formationControleur->supprimerFormation($url[1]);
            break;
            case "creer-formation":  $formationControleur->creerFormation();
            break;
            case "creer-formation-validation":  $formationControleur->creerFormationValidation(Securite::validerInputData($_POST['acronyme']),
               Securite::validerInputData($_POST['titre']),Securite::validerInputData($_POST['description']),
               Securite::validerInputData($_POST['pourqui']),Securite::validerInputData($_POST['prerequis']));
            break;
        
            case "creer-compte-formateur": $userControleur->CreerComptePartenaire();
            break;
            case "creer-compte-partenaire-validation": $userControleur->CreerComptePartenaireValidation(Securite::validerInputData($_POST['login']), 
                Securite::validerInputData($_POST['mail']),Securite::validerInputData($_POST['passwd']));
           
        
        
            /* ------ PARTENAIRE ------ */
            case "gerer-formation": $formationControleur->gererFormation();
            break;
            case "gerer-formation-validation": $formationControleur->gererFormation();
            break;
            case "renseigner-formation" : $formationControleur->RenseignerFormation($url[1]);
            break;
            case "renseigner-formation-validation" : $formationControleur->RenseignerFormationValidation($_POST['acronyme'], $_POST["intitule_sequence"],Securite::validerInputData($_POST['intitule']),Securite::validerInputData($_POST['type_document']));
            break;
            case "supprimer-ressource": $ressourceControleur->SupprimerRessource($url[1],$url[2],$url[3]);
            break;
            case "creer-sequence": $sequenceControleur->CreerSequence($url[1]);
            break;
            case "creer-sequence-validation": $sequenceControleur->CreerSequenceValidation($_POST['acronyme'],Securite::validerInputData($_POST['intitule']),Securite::validerInputData($_POST['description']));
            break;
        
        
        
            /* ------ TOUT LE MONDE ------ */
        
            case "contact": require "vue/contact.view.php";
            break;
            case "recuperer-mdp": $userControleur->RecupererMdp();
            break;
            case "recuperer-mail": $userControleur->EnvoiMailRecuperation($_POST['mail']);
            break;
            case "mention-legales": require "vue/mentionLegale.view.php";
            break;
            case "cookies": require "vue/cookies.view.php";
            break;
            case "donnees-personnelles": require "vue/donneesPersonnelles.view.php";
            break;
            case "supprimer-cookies": echo "supprimer-cookie";
                session_destroy();
                //unset($_COOKIE['cookie-accept']);
                setcookie('cookie-accept', '', time()-3600, '/', '', false, false);
                header("Location: index.php");
            break;
            case "cookie-accept" : // L'utilisateur a accepté l'utilisation de cookies
                    setcookie('cookie-accept', 'true', time() + 365 * 24 * 60 * 60, '/');
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
            case "cookie-refuse": $userControleur->UserRefuseCookie();
            break;
            case "application-android": require "vue/android.view.php";
            break;
            case "conditions-generales": require "vue/ConditionsGenerales.view.php";
            break;
            default: throw new Exception("La page n'existe pas");
        }
    }
}catch(Exception $e){
    $title = "Erreur";
    $erreurMsg = $e->getMessage();
    require "vue/erreur.view.php";
}
?>
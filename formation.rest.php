<?php
require_once "./model/FormationDao.class.php"; 
require_once "./model/UsersDao.class.php"; 

//use Firebase\JWT\JWT;
//use Illuminate\Http\Request;


$formationDao = FormationDao::getInstance();
$usersDao = UsersDao::getInstance();

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
    if ($_GET["operation"]=="login" && isset($_GET["login"]) && isset($_GET["password"])) {
        try {
            $login = $_GET["login"];
            $password = $_GET["password"];
            $user = $usersDao->findUserByLogin($login);
            if ($user != null && password_verify($password, $user->getPassword())) {
                // Générer un jeton JWT
                $secret_key = bin2hex(openssl_random_pseudo_bytes(16)); // Clé forte et aléatoire pour la sécurité.
                $issuer_claim = "http://10.0.2.2/CAFOMA/formation.rest.php"; // émetteur du token
                $audience_claim = "http://10.0.2.2/CAFOMA/formation.rest.php"; // Remplacez par l'URL de l'API
                $issuedat_claim = time(); // Timestamp de création du jeton
                $expire_claim = $issuedat_claim + 3600; // Timestamp d'expiration du jeton (1 heure)
                $token = array(
                    "iss" => $issuer_claim,
                    "aud" => $audience_claim,
                    "iat" => $issuedat_claim,
                    "exp" => $expire_claim,
                    "data" => array(
                        "user_id" => $user->getId(),
                        "user_login" => $user->getLogin()
                    )
                );
                $jwt = JWT::encode($token, $secret_key);

                // Envoyer la réponse avec le jeton JWT
                $response = array(
                    "login" => $user->getLogin(),
                    "token" => $jwt
                );
                print("login#OK" . json_encode($response));
            } else {
                print("login#erreur");
            }
        } catch (PDOException $e) {
            print "erreur#".$e->getMessage();
        }
    }



}
?>

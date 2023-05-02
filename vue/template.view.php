<?php require_once "./outil/Securite.class.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CAFOMA</title>
    <link rel="stylesheet" href="<?= URL ?>/css/style_commun.css" />
    <link rel="stylesheet" href="<?= URL ?>/css/style_menu.css" />
    <script src="https://kit.fontawesome.com/1c71a5a56d.js" crossorigin="anonymous"></script>
</head>

<body>  
       <nav id="nav_menu" class="navbar_menu">
            <img id="img_form_header" src="<?= URL ?>public/img/forme_header.png">
            <img id="img_logo_menu div_accueil" src="<?= URL ?>public/img/logo_cafoma.png">

            <div id="div_menu">
                
                <a id="a_accueil" href="<?= URL ?>accueil">Accueil</a>
                <a id="a_catalogue" href="<?= URL ?>afficher-catalogue">Catalogue</a>
                <?php if(Securite::verifAccessAdmin()){ ?>
                    <a id="a_administratif" href="<?= URL ?>administratif">Administration</a>
                <?php } ?>
                <?php if(Securite::verifAccessPartenaire()){ ?>
                    <a id="a_gererFormation" href="<?= URL ?>gerer-formation">Gérer formation</a>
                <?php } ?>
                <?php if(Securite::verifAccessEtudiant()){ ?>
                    <?php if(!Securite::verifAccessPartenaire() && !Securite::verifAccessAdmin()){ ?>
                        <a id="a_apprentissage" href="<?= URL ?>afficher-ses-inscription">Mon apprentissage</a>
                    <?php } ?>
                <?php } ?>
                    <a id="a_contact" href="<?= URL ?>contact">Contact</a>
                <?php if(!Securite::isConnected()){ ?>
                    <a id="a_creerCompte" href="<?= URL ?>creer-compte">Creer compte</a>
                    <a id="a_login" href="<?= URL ?>login">Se connecter</a>
                <?php } ?>
                <?php if(Securite::isConnected()){ ?>
                    <a id="a_profil" href="<?= URL ?>afficher-profil">profil</a>
                    <a id="a_logout" href="<?= URL ?>logout">Se déconnecter</a>        
                <?php } ?>
                
                
            </div>
        </nav>

    <div class="container">
        <h2><?php echo $titre ?></h2>
        <?php echo $content ?>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>



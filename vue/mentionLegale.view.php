<?php ob_start()?>

<div class="contenu_mention">
    <p>La juene ESN Badénia Tech est une société au capital de 150 000,00 euros, immatriculée au Registre du Commerce et des Sociétés de Paris sous le n. 471 254 569 et dont le siège social est situé au 2 Cour de l’Ile du Bonheur, 75004 Paris, France (N° TVA intracommunautaire : FR 87 473 771 323). Badénia Tech est représentée par M. Pierre Dupont, son Président.</p>

    <p>Badénia Tech est une jeune ESN, fondé en 2016 par une équipe de professionnels de l’informatique</p>

    <p>Le Directeur de la Publication de la plateforme et le Directeur de l'Établissement Privé à Distance est M. Pierre Dupont.</p>

    <p>Le site est hébergé par HOSTINGER INTERNATIONAL LTD, dont le siège social se situe 61 Lordou Vironos Street, 6023 Larnaca, Chypre, joignable par le moyen suivant : https://www.hostinger.fr/contact.</p>
    <br>
    Nous contacter :<br><br>
    
    Par email : contact@cafoma.online<br>
    Par courrier : Badénia Tech, 2 Cour de l’Ile du Bonheur, 75004 Paris, France<br><br>
    Vous bénéficiez d’un droit d’accès et de rectification aux informations qui vous concernent, que vous pouvez exercer par email à l’adresse data-protection@cafoma.online. Vous pouvez également, pour des motifs légitimes, vous opposer au traitement des données vous concernant.
    <br><br>
    <i>Pour plus d’informations sur tous vos droits vous pouvez vous référer à notre Politique de Protection des Données Personnelles.</i></p>
    </div>


<?php
    $content=ob_get_clean();
    $titre = "Mentions légales";
    require "template.view.php";
?>


<?php ob_start()?>
<h2 class="titre_page">Politique de Protection des Données Personnelles</h2>
  <p>La collecte et le traitement de vos données, effectués à partir du site https://cafoma.online/, sont conformes au règlement général (européen) sur la protection des données (RGPD) du 27 avril 2016, en application depuis le 25 mai 2018, et à la loi Informatique et Libertés du 6 janvier 1978 modifiée en 2018.</p>

  <h2>Base juridique et finalités des traitements</h2>
  <p>Les données personnelles récoltées sur ce site le sont dans le cadre d’une mission de service public, à des fins de gestion des comptes utilisateurs, d’analyse statistiques et de demande de suggestion d’achat.<br>
  Ces données sont collectées et réutilisées avec votre consentement explicite.<br>
  Vous pouvez à tout moment retirer ce consentement par saisie de ces services.</p>
  <p>Vous pouvez également saisir à cette fin le Délégué à la Protection des Données Personnelles :<br>
   data-protection@cafoma.online, ou par courrier à l'adresse suivante : 2 Cour de l’Ile du Bonheur, 75004, Paris</p>

  <h2>Données collectées</h2>
  <p>Les données personnelles collectées et traitées sont celles transmises lors de votre inscription aux formations, notamment vos nom, prénom,email, données de connexions.</p>

  <h2>Destinataire des données</h2>
  <p>Les données collectées sont transmises aux personnels de l'entreprise Badénia Tech de la ville de Paris. Aucun transfert, transmission ou cession de vos données à des tiers non autorisés n’a lieu. Aucune information personnelle autre que celles demandées explicitement n’est collectée à votre insu.</p>

  <h2>Caractère obligatoire ou facultatif de recueil des données</h2>
  <p>Chaque formulaire limite la collecte des données personnelles au strict nécessaire (minimisation des données).<br>
  Le caractère obligatoire des données demandées est symbolisé par un astérisque (*). Ainsi, vous devez impérativement renseigner les catégories de données obligatoires sous peine de ne pas pouvoir transmettre l’ensemble des données aux personnels
</p>

<?php
    $content=ob_get_clean();
    $titre = "";
    require "template.view.php";
?>
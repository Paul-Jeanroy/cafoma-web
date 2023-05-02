<?php ob_start();?>

<h2 class="titre_page">Accueil</h2>


<h4>Bienvenue sur le site Web CAFOMA</h4>
<br>
<p>
Notre mission est de fournir des formations de qualitées pour vous aider à acquérir de nouvelles compétences et à progresser dans votre apprentissage. Nous proposons une variété de cours pour débutants et avancés.
<br><br>
Nos cours sont conçus pour vous aider à acquérir des compétences pertinentes pour le marché du travail d'aujourd'hui mais également pour vos compétences personnelles à accomplir. Voici un exemple des compétences que vous pouvez acquérir en suivant nos cours :
<br><br>
Développement web : HTML, CSS, JavaScript, PHP, MySQL<br>
Développement mobile : iOS, Android, Swift, Kotlin<br>
Programmation orientée objet : Java, Python, C++<br>
<br><br>
[Insérez ici une image illustrant l'un des sujets de vos cours.]
<<img src="" alt="alt"/>
<br><br>
Nous sommes passionnés par l'aide aux développeurs pour améliorer leur carrière. Voici quelques-uns de nos conseils et ressources préférés pour les développeurs :
<br><br>
Suivez les blogs de développeurs pour rester au courant des dernières tendances et technologies.
Participez à des hackathons pour pratiquer vos compétences et rencontrer d'autres développeurs.
Utilisez des outils de développement tels que GitHub pour gérer vos projets et collaborer avec d'autres développeurs.
<br>
<br>
[Insérez ici une image montrant des développeurs travaillant sur un projet ensemble.]
<br>
Prêt à commencer à apprendre ? Inscrivez-vous dès maintenant à notre programme de formation pour développeurs et découvrez comment nous pouvons vous aider à atteindre vos objectifs de carrière.
<br>
</p>

<a id="a_creerCompte" href="<?= URL ?>creer-compte">Creer votre compte sans plus attendre !</a>

<?php
    $content=ob_get_clean();
    $titre = "";
    require "./vue/template.view.php";
?>
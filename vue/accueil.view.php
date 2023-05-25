<?php ob_start();?>

<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } else { ?>


<h2 class="titre_page">Bienvenue sur le site Web CAFOMA</h2>

    <div class="container" style="margin-top: 0px;">
        <div class="cards">
            <?php foreach($formations as $formation) { ?>
                <div class="card">
                    <h2 class="card-title"><?php echo $formation->getTitre(); ?></h2>
                    <img src="public/img/<?php echo $formation->getImage(); ?>" alt="Nom de l'image" class="card-img">
                    <a href="<?= URL ?>afficher-formation/<?php echo $formation->getAcronyme(); ?>" class="card-btn">Voir le détail</a>
                </div>
            <?php } ?>
        </div>
        <button class="prev-button">&lt;</button>
        <button class="next-button">&gt;</button>
      
    </div>
    <div class="button-container">
      <a href="<?= URL ?>afficher-catalogue" class="catalog-button">Voir le catalogue</a>
    </div>

<div class="div_section1_accueil">
    <div class="div_aff_txt_accueil">
        <p>Notre mission est de fournir des formations de qualitées pour vous aider à acquérir de nouvelles compétences
            et à progresser dans votre apprentissage. Nous proposons une variété de cours pour débutants et avancés quelque soit votre domaine et ce qu'il vous plait.
        <br><br>
        Nos cours sont conçus pour vous aider à acquérir des compétences pertinentes pour le marché du travail d'aujourd'hui mais également pour vos compétences personnelles à accomplir.
         Voici un exemple des compétences que vous pouvez acquérir en suivant nos cours :
        <br><br>
        <div class="div_img_form">
            <img src="public/img/img_dev.png" alt="alt" title="développeur"/>
            <img src="public/img/img_soignant.png" alt="alt" title="aide soignant"/> 
            <img src="public/img/img_fr.png" alt="alt" title="français"/>
            <img src="public/img/img_anglais.png" alt="alt" title="anglais"/>
            <img src="public/img/img_math.png" alt="alt" title="mathématiques"/>
        </div>
        <br><br>
        Prêt à commencer à apprendre ? Inscrivez-vous dès maintenant à notre programme de formation et découvrez comment nous pouvons vous aider à atteindre vos objectifs de carrière.
        <br>
        </p>
    </div>
    <div class="div_section1_img">
        <img src="public/img/Image_cours.jpg" alt="alt"/>
    </div>
</div>

<a id="a_creerCompte" href="<?= URL ?>creer-compte">Creer votre compte sans plus attendre !</a>



<?php } ?>
<script>
        const cards = document.querySelector(".cards");
        const prevButton = document.querySelector(".prev-button");
        const nextButton = document.querySelector(".next-button");

        let currentTranslateX = 0;
        const cardWidth = 220; // (200 + 20 margin-right)
        const cardCount = cards.children.length;
        const maxTranslateX = (cardWidth + 20) * (cardCount - 1); // display 5 cards at a time

        nextButton.addEventListener("click", () => {
          if (currentTranslateX > -maxTranslateX) {
            currentTranslateX -= cardWidth + 20;
            cards.style.transform = `translateX(${currentTranslateX}px)`;
          }
        });

        prevButton.addEventListener("click", () => {
          if (currentTranslateX < 0) {
            currentTranslateX += cardWidth + 20;
            cards.style.transform = `translateX(${currentTranslateX}px)`;
          }
        });

</script>



<?php
    $content=ob_get_clean();
    $titre = "";
    require "./vue/template.view.php";
?>
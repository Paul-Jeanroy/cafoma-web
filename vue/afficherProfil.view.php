<?php ob_start();
require_once "outil/Securite.class.php"; 
?>   



<div class="text-center">
    <h2 class="titre_page">Profil de : <?= $user->getLogin(); ?></h2>
    <br>
    <h4>role : <?= $user->getRole(); ?></h4>
    <br>
    <div>
        <div>
            <img width="100px" src="public/img/<?= $user->getImage();  ?>" alt="photo de profil" />
        </div>
        <form method="POST" action="<?= URL ?>modifier-image" enctype="multipart/form-data">
            <label for="image">Changer l'image de profil </label><br />
            <input type="file" class="form-control-file" id="image" name="image" onchange="submit();" />
        </form>
    </div>
    <br>      
    <h4>Votre mail</h4>
    <?= $user->getMail(); ?>    
    <br><br>

    <?php if(!Securite::verifAccessAdmin()){ ?>
        <div class="mb-3">
            <a href="<?= URL ?>supprimer-son-compte" class="btn btn-danger">Supprimer votre compte</a>
        </div>
    <?php } ?>
</div>


<?php
    $content=ob_get_clean();
    $titre = "";
    require "vue/template.view.php";
?>
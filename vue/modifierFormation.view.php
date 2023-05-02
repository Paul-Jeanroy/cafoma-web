<?php 
ob_start(); 
?>
<div class="container">
    <h2>Modifier la formation</h2>
    <br>
    
    <form method="POST" action="<?= URL ?>modifier-formation-validation" enctype="multipart/form-data">
        
        <div class="mb-3">
        <label class="form-label" for="acronyme">Acronyme : </label>
        <input class="form-control" type="text" id="acronyme" name="acronyme  " value="<?= $formations->getAcronyme() ?>">
      </div>
        
      <div class="mb-3">
        <label class="form-label" for="titre">Titre : </label>
        <input class="form-control" type="text" id="titre" name="titre" value="<?= $formations->getTitre() ?>">
      </div>
        
      <div class="mb-3">
        <label class="form-label" for="description">Description : </label>
        <input class="form-control" type="text" id="description" name="description" value="<?= $formations->getDescription() ?>">
      </div>
        
      <div class="mb-3">
        <label hidden class="form-label" for="login_createur"></label>
        <input hidden class="form-control" type="text" id="login_createur" name="login_createur" value="<?php $_SESSION['login'] ?>">
      </div>
      <img width="200px" src="public/images/<?php echo $formations->getImage(); ?>">
      <div class="mb-3">
        <label class="form-label" for="image">Image : </label>
        <input class="form-control" type="file" id="image" name="image">
      </div>
        <input type="hidden" name="id" value="<?= $formations->getAcronyme() ?>">
        <input type="hidden" name="image" value="<?= $formations->getImage() ?>">
        
      <div class="mb-3">
        <label class="form-label" for="video">Vidéo introduction : </label>
        <input class="form-control" type="file" id="video" name="video" value="<?= $formations->getVideo() ?>">
      </div>
        <input type="hidden" name="acronyme" value="<?= $formations->getAcronyme() ?>">
        <input type="hidden" name="video" value="<?= $formations->getVideo() ?>">        
       
      <div class="mb-3">
        <label class="form-label" for="pour_qui">Pour qui ? : </label>
        <input class="form-control" type="text" id="pour_qui" name="pour_qui" value="<?= $formations->getPourQui() ?>">
      </div>
        
      <div class="mb-3">
        <label class="form-label" for="prerequis">Prerequis ? : </label>
        <input class="form-control" type="text" id="prerequis" name="prerequis" value="<?= $formations->getPrerequis() ?>">
      </div>
      
      <input class="btn btn-primary" type="submit" value="modifier" name="form_ajouter"/> 
</form>
<?php
$content = ob_get_clean();
$titre = "";
require "template.view.php";
?>
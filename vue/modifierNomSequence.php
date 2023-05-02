<?php ob_start();?>

<div class="container">
    <h2 class="titre_page">Modifier le nom de la séquence : <?= $sequence->getIntitule(); ?></h2>
    <br>
    
    <form method="POST" action="<?= URL ?>modifier-nom-sequence-validation/<?= $sequence->getAcronyme(); ?>/<?= $sequence->getNumSequence(); ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="intitule"> Nouveau nom pour la séquence (intitule) :</label>
            <input class="form-control" type="text" id="intitule" name="intitule" value="">
        </div>
      
      <input class="btn btn-primary" type="submit" value="valider" name="form_ajouter"/> 
</form>
<?php
$content = ob_get_clean();
$titre = "";
require "template.view.php";
?>
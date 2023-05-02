
<?php 
ob_start(); 
?>

<div class="container">
    <h2>Créer une Séquence</h2>
    <form method="POST" action="<?= URL ?>creer-sequence-validation" enctype="multipart/form-data">
        <div class="mb-3">
             <input class="form-control" type="hidden" id="acronyme" name="acronyme" value="<?= $formations->getAcronyme(); ?>">
        </div>
        <div class="mb-3">
          <label class="form-label" for="intitule">intitulé : </label>
          <input class="form-control" type="text" id="intitule" name="intitule">
        </div>
        <div class="mb-3">
          <label class="form-label" for="description">Description : </label>
          <input class="form-control" type="text" id="desc" name="description">
        </div>
    <input class="btn btn-primary" type="submit" value="ajouter" name="form_ajouter"/> 
</form>
<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>
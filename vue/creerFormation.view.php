<?php 
ob_start(); 
?>

<div class="container">
    <h2>Créer une formation</h2>
    <form method="POST" action="<?= URL ?>creer-formation-validation" enctype="multipart/form-data">
      <div class="mb-3">
        <label class="form-label" for="titre">Titre : </label>
        <input class="form-control" type="text" id="titre" name="titre">
      </div>
      <div class="mb-3">
        <label class="form-label" for="acronyme">Acronyme: </label>
        <input class="form-control" type="text" id="acro" name="acronyme">
      </div>
      <div class="mb-3">
        <label class="form-label" for="description">Description : </label>
        <input class="form-control" type="text" id="desc" name="description">
      </div>
      <div class="mb-3">
        <label class="form-label" for="image">Image : </label>
        <input class="form-control" type="file" id="image" name="image">
      </div>
        <div class="mb-3">
            <label class="form-label" for="video">Video d'introduction : </label>
            <input class="form-control" type="file" id="video" name="video">
      </div>
        <div class="mb-3">
            <label class="form-label" for="pourqui">Pour qui ? : </label>
            <input class="form-control" type="text" id="pourqui" name="pourqui">
      </div>
        <div class="mb-3">
            <label class="form-label" for="prerequis">Prerequis : </label>
            <input class="form-control" type="text" id="prerequis" name="prerequis">
      </div>
     
      <input class="btn btn-primary" type="submit" value="ajouter" name="form_ajouter"/> 
</form>
<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>
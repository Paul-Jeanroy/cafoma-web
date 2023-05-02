<?php 
ob_start(); 
?>

    <form method="POST" action="<?= URL ?>recuperer-mdp-validation" enctype="multipart/form-data">
        
    <div class="mb-3">
        <label class="form-label" for="eamil">Veuillez rentrer votre Email </label>
        <input class="form-control" type="text" id="email" name="email" value="">
    </div>
    <input class="btn btn-primary" type="submit" value="valider" name="form_ajouter"/> 
</form>
    
<?php
$content = ob_get_clean();
$titre = "Récupération de mot de passe";
require "vue/template.view.php";
?>
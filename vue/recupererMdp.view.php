<?php 
ob_start(); 
?>

    <form method="POST" action="<?= URL ?>recuperer-mail" enctype="multipart/form-data">
        
    <div class="mb-3">
        <label class="form-label" for="mail">Veuillez rentrer votre Email </label>
        <input class="form-control" type="mail" id="mail" name="mail" required>
    </div>
    <input class="btn btn-primary" type="submit" value="valider" name="form_ajouter"/> 
</form>
    
<?php
$content = ob_get_clean();
$titre = "Récupération de mot de passe";
require "vue/template.view.php";
?>
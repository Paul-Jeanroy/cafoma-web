<?php 
ob_start(); 
?>
   
        <form action="<?= URL ?>reinit-passwd" method="post">
            <div class="mb-3">
              <label for="passwd1" class="form-label">Saisir votre nouveau mot de passe</label>
              <input type="password" class="form-control" id="passwd1" name="passwd1">
            </div>
            <div class="mb-3">
              <label for="passwd2" class="form-label">Saisir votre nouveau mot de passe</label>
              <input type="password" class="form-control" id="passwd2" name="passwd2">
            </div>
            <input type="hidden" value="<?= $login ?>" name="login"> 
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
        <?php if($alert !== ""){ ?>
            <div class="alert alert-danger" role="alert">
              <?= $alert ?>
            </div>              
        <?php } ?>        
        
 
<?php
$content = ob_get_clean();
$titre = "Formulaire de réinitialisation de mot de passe";
require "template.view.php";
?>
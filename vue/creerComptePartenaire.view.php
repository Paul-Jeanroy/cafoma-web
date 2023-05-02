<?php 
ob_start(); 
?>
<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } ?>
    <div class="div_administration">
        <div class="div_titre_admin">
            <a id="a_admin_util" href="<?= URL ?>administrer-utilisateur">Administrer les utilisateurs</a> 
            <a id="a_admin_form" href="<?= URL ?>administrer-formation">Administrer les formations</a>
            <a id="a_create_formateur" href="<?= URL ?>creer-compte-formateur">Créer compte Formateur</a>
        </div>
    </div>
        <form method="POST" action="<?= URL ?>creer-compte-partenaire-validation" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="username" class="form-label">Nom d'utilisateur</label>
              <input type="text" class="form-control" id="username" name="login">
            </div>
            <div class="mb-3">
              <label for="passwd" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="passwd" name="passwd">
            </div>
            <!-- version 3-01 -->
            <div class="mb-3">
                <label for="mail" class="form-label">mail</label>
                <input type="mail" class="form-control" id="mail" name="mail" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
<?php
$content = ob_get_clean();
$titre = "Créer compte partenaire";
require "template.view.php";
?>


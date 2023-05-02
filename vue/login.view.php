<?php ob_start(); ?>

<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } ?>  
<div class="wrapper">
    <div class="form-box login">
        <h2>Formulaire login</h2>
        <form method="POST" action="<?= URL ?>valider-login" enctype="multipart/form-data">
            <div class="input-box">
                <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                <label for="username" class="form-label" required>Nom utilisateur</label>
                <input type="text" class="form-control" id="username" name="login">
                
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                <label for="passwd" class="form-label" required>Mot de passe</label>
                <input type="password" class="form-control" id="passwd" name="password">
            </div>
            <div class="rember-forgot">
                <a href="<?= URL ?>recuperer-mdp">Mot de passe oublié ?</a>
            </div> 
            <div class="login-register">
                <p>Vous n'avez pas de compte ? <a href="<?= URL ?>creer-compte" class="register-link">S'inscrire</a></p>
            <button type="submit" class="btn btn_login">Se connecter</button>
        </form>
    </div>
</div>
</div>
    
    
    <img class="logo_code" src="public/img/logo_code.png">
    <img class="logo_ia" src="public/img/logo_ia.png">
<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>


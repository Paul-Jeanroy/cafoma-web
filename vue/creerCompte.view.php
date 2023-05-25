<?php 
ob_start(); 
?>

<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } ?>
<div class="wrapper_creercompte">
    <div class="form-box creer_compte">
        <h2>Formulaire création de compte</h2>
        <form method="POST" action="<?= URL ?>creer-compte-validation" enctype="multipart/form-data">
            <div class="input-box">
              <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
              <label for="username" class="form-label" required pattern="^[A-Aa-z '-]+$" maxlenght="20" >Nom d'utilisateur</label>
              <input type="text" class="form-control" id="username" name="login">
            </div>
            <div class="input-box">
                <span class="icon"><ion-icon name="eye-outline" id="show-password"></ion-icon><ion-icon name="eye-off-outline" id="hide-password"></ion-icon><ion-icon name="lock-closed-outline"></ion-icon></span>
              <label for="passwd" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="passwd" name="passwd">
              
            </div>
            <!-- version 3-01 -->
            <div class="input-box">
                <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                <label for="mail" class="form-label">mail</label>
                <input type="mail" class="form-control" id="mail" name="mail" required>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="mentions" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                  J'ai lu et j'accepte les conditions de service décrites dans les
                  <a href="<?= URL ?>mention-legales">mentions légales</a>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="perso" id="flexCheckIndeterminate">
                <label class="form-check-label" for="flexCheckIndeterminate">
                  J'accepte que mes données soient conservées pour avoir accès aux services du site de formation 
                </label>
            </div>
            <button type="submit" class="btn btn-success btn-creer-compte">Créer compte</button>
          </form>
    </div>
</div>

<script>
    const passwordInput = document.getElementById('passwd');
    const showPasswordButton = document.getElementById('show-password');
    const hidePasswordButton = document.getElementById('hide-password');

    showPasswordButton.addEventListener('click', () => {
      passwordInput.type = 'text';
    });

    hidePasswordButton.addEventListener('click', () => {
      passwordInput.type = 'password';
    });
</script>

<?php
$content = ob_get_clean();
$titre = "";
require "template.view.php";
?>


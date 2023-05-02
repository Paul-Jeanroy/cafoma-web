<?php ob_start()?>
    <div class="wrapper_contact">
        <div class="form-box contact">
            <h2>Formulaire de contact</h2>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <label for="username" class="form-label" required="">Adresse Mail</label>
                    <input type="mail" class="form-control" id="mail" name="mail">

                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="pencil-outline"></ion-icon></span>
                    <label for="sujet" class="form-label" required="">Sujet</label>
                    <input type="text" class="form-control" id="sujet" name="sujet">
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="document-text-outline"></ion-icon></span>
                    <label for="contenu" class="form-label" required="">Contenu</label>
                    <input type="text" class="form-control" id="contenu" name="contenu">
                </div>
                <button type="submit" class="btn btn_contact">Envoyer</button>

            </form>
        </div>
    </div>


 <?php
    $content=ob_get_clean();
    $titre = "";
    require "template.view.php";
?>



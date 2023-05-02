<?php ob_start()?>

<h2 class="titre_page">Application Android</h2>

Télécharger l'application android : <a href="">CAFOMA android</a>

<?php
    $content=ob_get_clean();
    $titre = "Android";
    require "template.view.php";
?>
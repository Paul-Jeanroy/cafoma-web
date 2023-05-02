<?php ob_start(); ?>  
    
    
    <h2 class="titre_page"><?= $ressource->getIntitule(); ?></h2>
    <video contextmenu="return false;" oncontextmenu="return false;" autoplay controls width="100%" controlsList="nodownload">
        <source src="<?= Constante::$ADRESSE_APPLICATION ?>public/ressource/<?= $ressource->getDocument() ?>" type="video/mp4">
    </video>

<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>


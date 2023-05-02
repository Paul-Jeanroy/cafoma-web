<?php ob_start() ?>

<h2 class="titre_page">Administration</h2>

<div class="div_administration">
    <div class="div_titre_admin">
        <a id="a_admin_util" href="<?= URL ?>administrer-utilisateur">Administrer les utilisateurs</a> 
        <a id="a_admin_form" href="<?= URL ?>administrer-formation">Administrer les formations</a>
    </div>
</div>





<?php
    $content=ob_get_clean();
    $titre = "";
    require "vue/template.view.php";
?>


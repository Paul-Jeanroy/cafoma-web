<?php 
ob_start(); 


?>

    <form method="POST" action="<?= URL ?>passer-certification-validation" enctype="multipart/form-data">
    
    <?php foreach($questions as $question) { 
        $reponseList = $question->getReponseList();?>
        
        <div class="mb-3 affichage_quest_rep">
            <label class="form-label" name="question" for="question"><?= $question->getQuestion() ?></label>
            <?php if(isset($reponseList)&&!empty($reponseList))
             foreach($reponseList as $reponse) { ?>
                <div class="div_affichage_reponse">
                    <input type="radio" value="<?= $reponse->getReponse(); ?>" name="reponse">
                    <span><?= $reponse->getReponse(); ?></span>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <input class="btn btn-primary" type="submit" value="valider" name="form_ajouter"/> 
</form>
    
<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>
<?php ob_start() ?>
 
<h4 class="titre_form">Titre : <?php echo $formation->getTitre(); ?></h4>

<a class="btn btn-retour" href="<?= URL ?>afficher-catalogue">Retour</a>
<br><br>

<div class="row">
    <div class="col-4">
        <video class="video_detail"contextmenu="return false;" oncontextmenu="return false;" controls controlsList="nodownload" autoplay muted width="400px" >
            <source src="<?= Constante::$ADRESSE_APPLICATION ?>public/ressource/<?php echo $formation->getVideo(); ?>" height="800px" type="video/mp4">
        </video>
    </div>
    <div class="col-8">
        <div class="row">
            <div class="col-10">
                
            </div>
        </div>
        <br>
        <h4>Description :</h4> 
        <p><?php echo $formation->getDescription(); ?></p>
        <h4>Prérequis :</h4> 
        <p><?php echo $formation->getPrerequis(); ?></p>
        <br>
    </div>
</div>

<?php 
$sequenceList = $formation->getSequenceList();
?>



<div class="affichage_ressource">
    <br><br>
    <div class="affichage_titre_ress">
        <h2 class="span_titre_aff_ressource">Contenu de ce cours</h2>
    </div>
    <div class="col-8">
        <br>
        <table class="table table-striped tab_form_ress">
            <thead>
                <?php if(isset($sequenceList)&&!empty($sequenceList))
                foreach ($sequenceList as $sequence) { ?>
                    <th class="intitule_sequence"><?= $sequence->getIntitule(); ?></th>
                </thead>
            <tbody>
                <tr><td><hr></td></tr>
                <?php } ?> <!-- Fin du Foreach 1 -->
               
                <?php if($sequenceList == null) { ?>
                    <div class="alert msg_alert alert-danger">
                        <span>Aucun cours renseigné pour cette formation...</span>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
    
    <br><br>
<!--    <a class="btn btn-success btn_certif" href="<?= URL ?>passer-certification/<?= $formation->getAcronyme(); ?>">Passer la certification</a>-->
</div>

<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>
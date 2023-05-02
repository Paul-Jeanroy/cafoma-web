<?php ob_start() ?>


<h4 class="titre_form">Titre : <?php echo $formation->getTitre(); ?></h4>
<div class="row">
        <div class="col-4">        
            <video contextmenu="return false;" oncontextmenu="return false;" controls="" width="340px">
		<source src="../public/video/<?= $formation->getvideo(); ?>" height="640px" type="video/mp4">
            </video>
	</div>
        <div class="col-8">
            <h4>Description :</h4> 
            <p><?php echo $formation->getDescription(); ?></p>
            <div class="row text-right">
                <div class="col-9"></div>
                <div class="col-3 text-end">

                </div>
            </div>
        </div>
    </div>

<?php 
$sequenceList = $formation->getSequenceList();
?>



<div class="affichage_ressource">
    <br><br>
    <div class="affichage_titre_ress">
        <h2 class="span_titre_aff_ressource">Suivre la formation</h2>
    </div>
    <div class="col-8">
        <br>
        <table class="table table-striped tab_form_ress">
            <thead>
                <?php if(isset($sequenceList)&&!empty($sequenceList))
                foreach ($sequenceList as $sequence) { ?>
                    <th class="intitule_sequence"><?= $sequence->getIntitule(); ?>
                        <?php if(Securite::verifAccessPartenaire() || Securite::verifAccessAdmin()) { ?>
                            <a href="<?= URL ?>modifier-nom-sequence/<?= $formation->getAcronyme(); ?>/<?= $sequence->getNumSequence    (); ?>" class="btn-modif-seq btn btn-warning">Mofidier</a>
                            <a href="<?= URL ?>supprimer-sequence/<?= $formation->getAcronyme(); ?>/<?= $sequence->getIntitule(); ?>" class="btn-suppr-seq btn btn-danger">Supprimer</a>
                        <?php } ?>
                    </th>
                </thead>
            <tbody>
                <?php $ressourceList = $sequence->getRessourceList(); ?>
                 <?php if($ressourceList == null) { ?>
                    <td class="intitule_ressource">
                           <div class="alert msg_alert alert-danger">
                               <span>Aucune Ressource de disponnible pour cette séquence !</span>
                           </div>
                    </td>
                <?php } ?>
                
                <?php if(isset($ressourceList)&&!empty($ressourceList))
                    foreach ($ressourceList as $ressource) { ?>

            
                        <td class="intitule_ressource">     
                            <span><?= $ressource->getIntitule(); ?></span>
                            <?php if($ressource->getType() == "video"){ ?> 
                                <a href="<?= URL ?>afficher-ressource/<?= $formation->getAcronyme(); ?>/<?= $sequence->getNumSequence(); ?>/<?= $ressource->getNumRessource(); ?>" class="btn btn-info btn_consulter_ress">Consulter la video</a>
                            <?php } if($ressource->getType() == "pdf"){ ?>
                                <a href="<?= Constante::$ADRESSE_APPLICATION ?>public/ressource/<?= $ressource->getDocument(); ?>" download class="btn btn-info btn_consulter_ress">Télécharger le fichier PDF</a>
                            <?php } ?>
                            <?php if(Securite::verifAccessPartenaire() || Securite::verifAccessAdmin()) { ?>
                            <a href="<?= URL ?>supprimer-ressource/<?= $formation->getAcronyme(); ?>/<?= $sequence->getNumSequence(); ?>/<?= $ressource->getNumRessource(); ?>" class="btn-suppr-res btn btn-danger">Supprimer</a>
                        </td>
                            <?php } ?> <!-- Fin du IF POUR LE ROLE-->

                    <?php }?> <!-- Fin du Foreach 2 -->
                <?php } ?> <!-- Fin du Foreach 1 -->
                
                <?php if($sequenceList == null) { ?>
                    <div class="alert msg_alert alert-danger">
                        <span>Aucune Séquence de disponnible pour cette formation !</span>
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
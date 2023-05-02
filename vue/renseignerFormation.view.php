<?php ob_start(); 
$sequenceList = $formation->getSequenceList();
?>


<div class="row">
    <h4><?= $formation->getTitre(); ?></h4>
    <br><br><br>
    
    <form method="POST" action="<?= URL ?>renseigner-formation-validation" enctype="multipart/form-data">
        <div class="mb-3">
             <input class="form-control" type="hidden" id="acronyme" name="acronyme" value="<?= $formation->getAcronyme(); ?>">
        </div>
        <?php if($sequenceList == null) { ?>
            <div class="mb-3">
                 <input class="form-control" type="hidden" id="acronyme" name="acronyme" value="<?= $formation->getAcronyme(); ?>">
            </div>
        <?php } ?>
        <div class="mb-3">
            <label class="form-label" for="sequence_intitule_a_creer"> Vous voulez créer une nouvelle séquence ? </label>
            <br>
            <a class="btn btn-info" href="<?= URL ?>creer-sequence/<?= $formation->getAcronyme(); ?>">Créer une séquence</a>
        </div>
        
        <div class="mb-3">
            <br>    
            <?php if(isset($sequenceList)&&!empty($sequenceList)) {?>
                    
                <label class="form-label" for="sequence_intitule"> Veuillez choisir dans quelle séquence voulez vous ajouter votre ressource : </label>
                <br>
                <div class="div_gerer_sequence">
                    <span class="myarrow"><img src="../public/img/fleche_bas.png"></span>
                    <select class="form-control sel_sequence" name="intitule_sequence"> 
                        <?php foreach ($sequenceList as $sequence) { ?>
                        <?php if(isset($sequence) && !empty($sequence)) { ?>
                        <option value="<?= $sequence->getIntitule(); ?>"><?= $sequence->getIntitule(); ?></option>
                        
                        
                <?php } ?>
                       
            <?php  } ?>
                    </select>
                    </div>
                    <br>
            <?php } ?>
                
        <?php if($sequenceList !== null) { ?>         
        
            <div class="mb-3">
                 <label class="form-label" for="intitule">Intitulé : </label>
                 <input class="form-control" type="text" id="intitule" name="intitule">
            </div>
            <div class="mb-3">
                 <label class="form-label" for="type_document">Type document : </label>
                 <input class="form-control" type="text" id="type_document" name="type_document">
            </div> 
            <div class="mb-3">
                <label class="form-label" for="document">Document : </label>
                <input class="form-control" type="file" id="document" name="document">
            </div>
          <input class="btn btn-primary" type="submit" value="ajouter" name="form_ajouter"/>
      
      <?php  } else { ?>
          <br><br>
          <span class="msg_alert_renseigner">Vous devez créer une séquence afin de renseigner vos ressources dedans.</span>
      <?php } ?>
    </form>
</div>






<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>


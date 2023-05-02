<?php 
  require_once "outil/Outils.class.php"; 
  ob_start(); 
?>

<h2 class="titre_page">Catalogue</h2>

<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } else { ?>





<div class="row">
    <?php foreach($formations as $formation) { ?>
    <hr>
        <div class="col-3">
              <img height="200" width="100%" src="public/img/<?php echo $formation->getImage(); ?>" alt="image">
        </div>
        <div class="col-9">
            <h4><?php echo $formation->getTitre(); ?></h4>
            <p style="margin-bottom: 8px;" class="card-text restricted" ><?php echo $formation->getDescription(); ?></p>
            <div><b>Prérequis : </b><i><?php echo $formation->getPrerequis(); ?></i></div>
            <div class="row text-right">
                <div class="col-9"></div>
                <div class="col-3 text-end">
                    <a href="<?= URL ?>afficher-formation/<?php echo $formation->getAcronyme(); ?>" class="btn btn-primary">Détail</a>
                    <?php if(Securite::isConnected()){ ?>
                    <?php if(!Securite::verifAccessPartenaire()){ ?>
                        <a href="<?= URL ?>inscrire-formation/<?php echo $formation->getAcronyme(); ?>" class="btn btn-success">S'inscrire</a>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<?php } ?>



<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>  



<?php ob_start();
 require_once "outil/Outils.class.php"; 
 require_once "model/FormationDao.class.php" ;
 ?>

<h2 class="titre_page">Mon apprentissage</h2>

<?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
<?php } else { ?>
  <div class="row">
    <?php $i=0; ?>
    <?php foreach($formations as $formation) { ?>
      <div class="col-3">
        <div class="card p-1 m-1" style="max-width: 19rem; height: 25rem;">
          <img width="91" height="200" src="public/img/<?php echo $formation->getImage(); ?>" class="card-img-top" alt="image">
          <div class="card-body">
            <h5 class="card-title"><?php echo $formation->getTitre(); ?></h5>
            <div class="btn-mescours">
                <a href="<?= URL ?>afficher-formation-ressource/<?php echo $formation->getAcronyme();?>" class="btn btn-primary">Suivre</a>
                <?php if(Securite::isConnected()){ ?>
                    <a href="<?= URL ?>desinscrire-formation/<?php echo $formation->getAcronyme();?>" class="btn btn-danger">désinscrire</a>
                <?php } ?>
            </div>
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

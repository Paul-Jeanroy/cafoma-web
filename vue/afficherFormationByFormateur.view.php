<?php 
ob_start(); 
?>
<h2 class="titre_page">Gérer ses formations</h2>


    <?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
    <?php } else { ?>
    <table class="table table-striped table_form_part">
      <thead>
        <tr>
          <th scope="col">Acronyme</th>
          <th scope="col">Image</th>
          <th scope="col">Titre</th>
          <th scope="col" colspan="3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($formations as $formation) { ?>
          <tr class="align-middle">
            <td><?php echo $formation->getAcronyme(); ?></td>
            <td><img width="50" src="./public/img/<?php echo $formation->getDescription(); ?>"></td>
            <td><?php echo $formation->getTitre(); ?></td>
            <td><a href="<?= URL ?>afficher-formation-ressource/<?= $formation->getAcronyme(); ?>" class="btn btn-info">Afficher détail</a></td>
<!--            <td><a href="<?= URL ?>modifier-formation/<?= $formation->getAcronyme(); ?>" class="btn btn-warning">Modifier</a></td>-->
            <td><a href="<?= URL ?>renseigner-formation/<?= $formation->getAcronyme(); ?>" class="btn btn-warning">Gérer Ressources/Sequences</a></td>
      <!--  <td><a href="<?= URL ?>renseigner-uestion-reponse/<?= $formation->getAcronyme(); ?>" class="btn btn-warning">Gérer Questions/Reponses</a></td> -->
            <td><a href="<?= URL ?>supprimer-formation/<?= $formation->getAcronyme(); ?>" class="btn btn-danger">Supprimer</a></td>
            
          </tr>
        <?php } ?>
      </tbody>
    </table> 
    <?php } ?>

    <a id="a_creerFormation" class="btn btn-info text-right" href="<?= URL ?>creer-formation">Créer formation</a>
<?php
$content = ob_get_clean();
$titre = "";
require "vue/template.view.php";
?>


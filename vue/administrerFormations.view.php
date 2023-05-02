<?php ob_start()?>
<?php require_once "outil/Constante.class.php"; ?>

<h2 class="titre_page">Administration des formations</h2>



<div class="container">
    <div class="div_administration">
    <div class="div_titre_admin">
        <a id="a_admin_util" href="<?= URL ?>administrer-utilisateur">Administrer les utilisateurs</a> 
        <a id="a_admin_form" href="<?= URL ?>administrer-formation">Administrer les formations</a>
        <a id="a_create_form" href="<?= URL ?>creer-formation">Créer formation</a>
    </div>
</div>
    <?php if($alert !== ""){ ?>
    <div class="alert alert-danger" role="alert">
        <?= $alert ?>
    </div>              
    <?php } else { ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Acronyme</th>
          <th scope="col">Image</th>
          <th scope="col">Titre</th>
          <th scope="col" colspan="3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($formationList as $formation) { ?>
          <tr class="align-middle">
            <td><?php echo $formation->getAcronyme(); ?></td>
            <td><img width="80" src="public/img/<?php echo $formation->getImage(); ?>"></td>
            <td><?php echo $formation->getTitre(); ?></td>
            <td><a href="<?= URL ?>afficher-formation/<?= $formation->getAcronyme(); ?>" class="btn btn-info">Afficher détail</a></td>
<!--            <td><a href="<?= URL ?>modifier-formation/<?= $formation->getAcronyme(); ?>" class="btn btn-warning">Modifier</a></td>-->
            <td><a href="<?= URL ?>renseigner-formation/<?= $formation->getAcronyme(); ?>" class="btn btn-warning">Renseigner</a></td>
            <td><a href="<?= URL ?>supprimer-formation/<?= $formation->getAcronyme(); ?>" class="btn btn-danger">Supprimer</a></td>
            
          </tr>
        <?php } ?>
      </tbody>
    </table> 
    <?php } ?>
</div> 
<?php
    $content=ob_get_clean();
    $titre = "";
    require "vue/template.view.php";
?>
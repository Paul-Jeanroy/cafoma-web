<?php ob_start()?>
<?php //require_once "model/LivreDao.php"; ?>
<?php //afficherTableau($tabLivres,"tabLivres"); ?>

<h2 class="titre_page">Administration des utilisateurs</h2>

<div class="container">
    <div class="div_administration">
    <div class="div_titre_admin">
        <a id="a_admin_util" href="<?= URL ?>administrer-utilisateur">Administrer les utilisateurs</a> 
        <a id="a_admin_form" href="<?= URL ?>administrer-formation">Administrer les formations</a>
        <a id="a_create_formateur" href="<?= URL ?>creer-compte-formateur">Créer compte Formateur</a>
    </div>
</div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Nom utilisateur</th>
          <th scope="col">Mail</th>
          <th scope="col">Rôle</th>
          <th scope="col">Valide</th>
          <th scope="col">Mot de passe hashé</th>
          
        </tr>
      </thead>
      <tbody>
        <?php foreach($users as $user) { ?>
          <tr class="align-middle">
            <td><?php echo $user->getLogin(); ?></td>
            <td><?php echo $user->getMail(); ?></td>
            <td><?php echo $user->getRole(); ?></td>
            <td><?php echo $user->getEstValide(); ?></td>
            <td><?php echo $user->getPassword(); ?></td>
            <td>
                <?php if($user->getRole() == "etudiant" || $user->getRole() == "partenaire"){ ?>
                    <a href="<?= URL ?>supprimer-utilisateur/<?= $user->getLogin(); ?>" class="btn btn-danger">Supprimer</a>
                <?php } ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table> 
</div> 
<?php
    $content=ob_get_clean();
    $titre = "";
    require "vue/template.view.php";
?>
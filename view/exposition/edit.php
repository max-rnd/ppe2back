<h1>Editer l'exposition</h1>

<div class="row">
    <div class="form-group">
        <div>Titre</div>
        <input type="text" class="form-control" value="<?php echo $expo->getTitre(); ?>">
    </div>
    <div class="form-group">
        <div>Début</div>
        <input type="date" class="form-control" value="<?php echo $expo->getDateDebut(); ?>">
    </div>
    <div class="form-group">
        <div>Fin</div>
        <input type="date" class="form-control" value="<?php echo $expo->getDateFin(); ?>">
    </div>
</div>
<div>
    <div class="form-group">
        <div>Artiste sélectionné</div>
        <input type="text" class="form-control" value="<?php $artiste->getNom(); ?>">
    </div>
</div>
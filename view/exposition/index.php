<h1>Liste des expositions</h1>

<table class="table">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Début</th>
            <th>Fin</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($expos as $expo) { ?>
        <tr>
            <td><?php echo $expo->getTitre(); ?></td>
            <td><?php echo $dd = $expo->getDateDebut(); ?></td>
            <td><?php echo $df = $expo->getDateFin(); ?></td>
            <td>
                <a href="/edit/<?php echo $expo->getId(); ?>" class="btn btn-primary">Editer</a>
                <a href="/delete/<?php echo $expo->getId(); ?>" class="btn btn-danger">Suppreimer</a>
                <?php
                    $n = date("Y-m-d");
                    if ($dd < $n && $df > $n) {
                        echo "En se moment !";
                    }
                ?>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div>
    <a href="" class="btn btn-success">Nouvelle exposition</a>
</div>
<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <style>
        body {
            padding: 4rem;
        }
    </style>
</head>
<body>
<div>
    <div class="form-inline">
        <label>Sélectionner une exposition</label>
        <select class="custom-select" id="selectExpo"></select>
        <a href="admin/expo.php" class="btn btn-success">Créer</a>
        <span id="expoStatus"></span>
    </div>
    <div class="form-inline">
        <div class="input-group">
            <label for="dateDebut">Début</label>
            <input type='date' class="form-control" id="dateDebut"/>
        </div>
        <div class="input-group">
            <label for="dateFin">Fin</label>
            <input type='date' class="form-control" id="dateFin"/>
        </div>
        <div class="input-group">
            <label for="dateFin">Titre</label>
            <input type='text' class="form-control" id="titreExpo"/>
        </div>
        <button class="btn btn-primary">Mettre à jour</button>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="admin/js/main.js"></script>
</body>
</html>
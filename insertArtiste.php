<?php
require_once "vendor/autoload.php";
include_once "modele/initPdo.php";

// Données

$nom = "nomArt";
$prenom = "prenomArt";
$portait = "portArt.jpg";
$resuBio = "Résumé de bio d'un artiste";
$bio = "Biographie d'un artiste";

// -------

$artiste = new \metier\artiste($dbh,$ObjLog);
$artiste->setNom($nom);
$artiste->setPrenom($prenom);
$artiste->setPortait($portait);
$artiste->setResuBio($resuBio);
$artiste->setBio($bio);

$dao = new \modele\daoArtiste($dbh,$ObjLog);
$dao->insert($artiste);

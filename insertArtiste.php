<?php
include_once "metier/artiste.php";
include_once "modele/initPdo.php";
include_once "modele/daoArtiste.php";

// Données

$nom = "Gami";
$prenom = "Yatosu";
$portait = "bg.jpg";
$resuBio = "Un 10E";
$bio = "Big boss du game";

// -------

$artiste = new \metier\artiste();
$artiste->setNom($nom);
$artiste->setPrenom($prenom);
$artiste->setPortait($portait);
$artiste->setResuBio($resuBio);
$artiste->setBio($bio);

$dao = new \modele\daoArtiste($dbh,$ObjLog);
$dao->insert($artiste);

<?php
require_once "vendor/autoload.php";
include_once "modele/initPdo.php";

// Données

$titre = "Une exposition";
$noteComm = "Voila la note du commissaire";
$dateDebut = new \DateTime("2020-01-01");
$dateFin = new \DateTime("2022-01-01");
$artiste = 1;

// -------

$expo = new \metier\exposition();
$expo->setTitre($titre);
$expo->setNoteComm($noteComm);
$expo->setDateDebut($dateDebut);
$expo->setDateFin($dateFin);
$expo->setArtiste($artiste);

$dao = new \modele\daoExposition($dbh,$ObjLog);
$dao->insert($expo);
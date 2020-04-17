<?php
include_once "metier/exposition.php";
include_once "modele/initPdo.php";
include_once "modele/daoExposition.php";

// Données

$titre = "Une exposition";
$noteComm = "Voila la note du commissaire";
$dateDebut = new \DateTime("2020-01-01");
$dateFin = new \DateTime("2021-01-01");

// -------

$expo = new \metier\exposition();
$expo->setTitre($titre);
$expo->setNoteComm($noteComm);
$expo->setDateDebut($dateDebut);
$expo->setDateFin($dateFin);

$dao = new \modele\daoExposition($dbh,$ObjLog);
$dao->insert($expo);
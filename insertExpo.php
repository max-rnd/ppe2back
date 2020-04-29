<?php
include_once "metier/exposition.php";
include_once "modele/initPdo.php";
include_once "modele/daoExposition.php";

// Données

$titre = "Une autre exposition";
$noteComm = "Voila l'autre note du commissaire";
$dateDebut = new \DateTime("2021-01-01");
$dateFin = new \DateTime("2022-01-01");

// -------

$expo = new \metier\exposition();
$expo->setTitre($titre);
$expo->setNoteComm($noteComm);
$expo->setDateDebut($dateDebut);
$expo->setDateFin($dateFin);

$dao = new \modele\daoExposition($dbh,$ObjLog);
$dao->insert($expo);
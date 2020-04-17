<?php
include_once "modele/const.php";
include_once "modele/initPdo.php";
include_once "modele/daoExposition.php";
include_once "metier/exposition.php";

$expo = new \metier\exposition();

echo json_encode($expo);
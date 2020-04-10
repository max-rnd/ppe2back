<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("vendor/autoload.php");

$dao = new \modele\daoExposition($dbh,$ObjLog);

echo json_encode($dao->getExpoEnCours());
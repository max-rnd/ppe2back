<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

//require_once("vendor/autoload.php");
include_once "modele/initPdo.php";
include_once "modele/daoExposition.php";

$dao = new \modele\daoExposition($dbh,null);

echo json_encode($dao->getAllExpo());
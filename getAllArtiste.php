<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("vendor/autoload.php");
include_once "modele/initPdo.php";

$dao = new \modele\daoArtiste($dbh,$ObjLog);

echo json_encode($dao->getAllArtiste());
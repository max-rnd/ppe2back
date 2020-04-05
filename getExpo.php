<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once("vendor/autoload.php");

$lexpo = new \metier\exposition(
    "Une expo",
    new \DateTime("2020-01-02"),
    new \DateTime("2020-02-02")
);

echo json_encode($lexpo);
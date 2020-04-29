<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once(__DIR__ . "/vendor/autoload.php");
include_once "modele/initPdo.php";

$app = AppFactory::create();

$app->get("/", function (Request $request, Response $response, $args) use ($dbh, $ObjLog) {
    $dao = new \modele\daoExposition($dbh, $ObjLog);
    $expo = $dao->getExpoEnCours();
    if ($expo->getTitre() == "NULL")
        $expo = $dao->getProchaineExpo();
    $response->getBody()->write(json_encode($expo));
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->run();
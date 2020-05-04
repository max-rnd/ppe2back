<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once "vendor/autoload.php";
include_once "modele/initPdo.php";

$app = AppFactory::create();

$app->get("/expo", function (Request $request, Response $response, $args) use ($dbh, $ObjLog) {
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

$app->post('/expo', function (Request $request, Response $response, array $args) use ($dbh,$ObjLog)  {
    $dao = new \modele\daoExposition($dbh,$ObjLog);
    $allPostPutVars= $request->getParsedBody();
    $lexpo = new \metier\exposition();

    $lexpo->setNom($allPostPutVars["Nom"]);
    $lexpo->setDateDebut(\DateTime::createFromFormat("Y-m-d",$allPostPutVars["DateDebut"]));
    $lexpo->setDateFin(\DateTime::createFromFormat("Y-m-d",$allPostPutVars["DateFin"]));
    $lexpo->setIdArtiste(1);            // en attendant de gérer les artistes
    $lexpo->setId( $dao->insert($lexpo));       // si l'id =0 alors l'insertion ne s'est pas faite

    $response->getBody()->write(json_encode($lexpo));   // on retourne l'enregistrement
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/expo/All', function (Request $request, Response $response, $args) use ($dbh,$ObjLog) {
    $dao = new \modele\daoExposition($dbh,$ObjLog);
    $response->getBody()->write(json_encode($dao->getAllExpo()));
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/artiste/expo/{id}', function (Request $request, Response $response, array $args) use ($dbh,$ObjLog) {
    $dao = new \modele\daoArtiste($dbh,$ObjLog);
    $response->getBody()->write(json_encode($dao->getArtiste($args['id'])));
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/artiste/All', function (Request $request, Response $response, array $args) use ($dbh,$ObjLog) {
    $dao = new \modele\daoArtiste($dbh,$ObjLog);
    $response->getBody()->write(json_encode($dao->getAllArtiste()));
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/oeuvre/{id}', function (Request $request, Response $response, array $args) use ($dbh,$ObjLog) {
    $dao = new \modele\daoOeuvre($dbh,$ObjLog);
    $response->getBody()->write(json_encode($dao->getOeuvres($args['id'])));
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->get('/film/{id}', function (Request $request, Response $response, array $args) use ($dbh,$ObjLog) {
    $dao = new \modele\daoFilm($dbh,$ObjLog);
    $response->getBody()->write(json_encode($dao->getFilms($args['id'])));
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
});

$app->run();
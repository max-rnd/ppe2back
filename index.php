<?php
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__."/vendor/autoload.php";

$app = AppFactory::create();

// Default page
$app->get("/", function (Request $request, Response $response, $args) {
    return $response;
});

// Header
function addHeader(Response $response) : Response {
    return $response
        ->withHeader('Access-Control-Allow-Origin', '*')
        ->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
}

// EXPOSITION
$app->get("/expo", function (Request $request, Response $response, $args) {
    $dao = new \model\daoExposition();
    $expo = $dao->getExpoEnCours();
    if ($expo->getTitre() == "NULL")
        $expo = $dao->getProchaineExpo();
    $response->getBody()->write(json_encode($expo));
    return addHeader($response);
});
$app->get("/allexpo", function (Request $request, Response $response, $args) {
    $dao = new \model\daoExposition();
    $expo = $dao->getAllExpo();
    $response->getBody()->write(json_encode($expo));
    return addHeader($response);
});
$app->get("/expo/{idExpo}", function (Request $request, Response $response, $args) {
    $dao = new \model\daoExposition();
    $expo = $dao->getExpo($args['idExpo']);
    if ($expo->getTitre() == "NULL")
        $expo = $dao->getProchaineExpo();
    $response->getBody()->write(json_encode($expo));
    return addHeader($response);
});
$app->post('/expo/{idExpo}/edit', function (Request $request, Response $response, $args) {
    $dao = new model\daoExposition();
    $allPostPutVars= $request->getParsedBody();
    $lexpo = new \metier\exposition();

    $lexpo->setId($args['idExpo']);
    $lexpo->setTitre($allPostPutVars['titre']);
    $lexpo->setDateDebut(new \DateTime($allPostPutVars['dateDebut']));
    $lexpo->setDateFin(new \DateTime($allPostPutVars['dateFin']));
    $lexpo->setNoteComm($allPostPutVars['noteComm']);
    $lexpo->setArtiste($allPostPutVars['artiste']);

    if ($dao->edit($lexpo)) {
        $response->getBody()->write(json_encode($lexpo));
    }
    else {
        $response->getBody()->write("fail");
    }
    return addHeader($response);
});

// ARTISTE
$app->get('/artiste/{idArtiste}', function (Request $request, Response $response, array $args) {
    $dao = new \model\daoArtiste();
    $response->getBody()->write(json_encode($dao->getArtiste($args['idArtiste'])));
    return addHeader($response);
});
$app->get("/allartiste", function (Request $request, Response $response, $args) {
    $dao = new \model\daoArtiste();
    $artiste = $dao->getAllArtiste();
    $response->getBody()->write(json_encode($artiste));
    return addHeader($response);
});

// OEUVRE
$app->get('/oeuvres/{idArtiste}', function (Request $request, Response $response, array $args) {
    $dao = new \model\daoOeuvre();
    $response->getBody()->write(json_encode($dao->getOeuvres($args['idArtiste'])));
    return addHeader($response);
});

// FILM
$app->get('/films/{idArtiste}', function (Request $request, Response $response, array $args) {
    $dao = new \model\daoFilm();
    $response->getBody()->write(json_encode($dao->getFilms($args['idArtiste'])));
    return addHeader($response);
});

$app->run();
<?php
use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once __DIR__."/vendor/autoload.php";

//$container = new Container();
//$container->set('upload_directory', __DIR__ . '/uploads');

//AppFactory::setContainer($container);
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

// GET

$app->get("/expo", function (Request $request, Response $response, $args) {
    $dao = new \model\daoExposition();
    $expo = $dao->getExpoEnCours();
    if ($expo->getTitre() == "NULL")
        $expo = $dao->getProchaineExpo();
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

$app->get("/allExpo", function (Request $request, Response $response, $args) {
    $dao = new \model\daoExposition();
    $expo = $dao->getAllExpo();
    $response->getBody()->write(json_encode($expo));
    return addHeader($response);
});

$app->get('/artiste/{idArtiste}', function (Request $request, Response $response, array $args) {
    $dao = new \model\daoArtiste();
    $response->getBody()->write(json_encode($dao->getArtiste($args['idArtiste'])));
    return addHeader($response);
});

$app->get('/oeuvres/{idArtiste}', function (Request $request, Response $response, array $args) {
    $dao = new \model\daoOeuvre();
    $response->getBody()->write(json_encode($dao->getOeuvres($args['idArtiste'])));
    return addHeader($response);
});

$app->get('/films/{idArtiste}', function (Request $request, Response $response, array $args) {
    $dao = new \model\daoFilm();
    $response->getBody()->write(json_encode($dao->getFilms($args['idArtiste'])));
    return addHeader($response);
});


// POST

// titre ; noteComm ; dateDebut ; dateFin ; idArtiste
$app->post('/expo/new', function (Request $request, Response $response, $args) {
    $dao = new model\daoExposition();
    $allPostPutVars= $request->getParsedBody();
    $lexpo = new \metier\exposition();

    $lexpo->setTitre($allPostPutVars['titre']);
    $lexpo->setNoteComm($allPostPutVars['noteComm']);
    $lexpo->setDateDebut(\DateTime::createFromFormat("Y-m-d",$allPostPutVars["DateDebut"]));
    $lexpo->setDateFin(\DateTime::createFromFormat("Y-m-d",$allPostPutVars["DateFin"]));
    $lexpo->setArtiste($allPostPutVars['idArtiste']);
    $dao->insert($lexpo);

    if ($dao->insert($lexpo)) {
        $response->getBody()->write(json_encode($lexpo));
    }
    else {
        $response->getBody()->write("fail");
    }
    return addHeader($response);
});

// model etd4 (avec fichier)
$app->post('/artiste/new', function (Request $request, Response $response, $args) {
    $dao = new model\daoArtiste();
    // on récupère les variables passées en post
    $allPostPutVars= $request->getParsedBody();
    $directory = $this->get('upload_directory');
    $uploadedFiles = $request->getUploadedFiles();
    $uploadedFile = $uploadedFiles['nomAffiche'];
    $filename = $uploadedFile->getClientFilename();
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $uploadedFile->moveTo($directory. DIRECTORY_SEPARATOR. $filename);
    }
    $lartiste = new \metier\artiste();

    $lartiste->setNom($allPostPutVars["Nom"]);
    $lartiste->setPortait($filename);
    // $lartiste->setIdArtiste(1);            // en attendant de gérer les artistes
    //$lartiste->setId( $dao->insert($lexpo));       // si l'id =0 alors l'insertion ne s'est pas faite

    return addHeader($response);
});


$app->run();
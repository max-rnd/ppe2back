<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once $_SERVER['DOCUMENT_ROOT']."/vendor/autoload.php";


$app = AppFactory::create();

$app->get("/", function (Request $request, Response $response, $args) {
    $response->withBody('/');
    return $response;
});

$app->run();
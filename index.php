<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require_once(__DIR__ . '/vendor/autoload.php');
include_once "modele/initPdo.php";

$app = AppFactory::create();
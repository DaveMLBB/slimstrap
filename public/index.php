<?php

require "../bootstrap.php";

use Slim\Psr7\Request;
use Slim\Psr7\Response;

$app = require "../bootstrap.php"; // Carica l'applicazione Slim creata in bootstrap.php

$app->get('/', function(Request $request, Response $response, array $args) {
    $response->getBody()->write(dd($request));
    return $response;
});

$app->run();
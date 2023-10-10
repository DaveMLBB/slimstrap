<?php

require "../bootstrap.php";

use Slim\Http\Request;
use Slim\Http\Response;

$app = require "../bootstrap.php"; // Carica l'applicazione Slim creata in bootstrap.php

$app->get('/', function(Request $request, Response $response, array $args) {
    $response->getBody()->write(dd($request));
    return $response;
});

$app->run();
<?php

require "../bootstrap.php";

$app = require "../bootstrap.php"; // Carica l'applicazione Slim creata in bootstrap.php

$app->get('/', function($request, $response) {
    $response->getBody()->write('home');
    return $response;
});

$app->run();
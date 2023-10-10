<?php

require "vendor/autoload.php";

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;

// Crea un container di dipendenze utilizzando PHP-DI
$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

// Configura Slim per utilizzare il container di dipendenze e l'implementazione PSR-17
AppFactory::setContainer($container);
AppFactory::setResponseFactory(new ResponseFactory());

$app = AppFactory::create();

// Aggiungi altre configurazioni globali, middleware, ecc., se necessario

return $app;
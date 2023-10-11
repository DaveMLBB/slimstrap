<?php

require "vendor/autoload.php";

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\Psr7\Factory\ResponseFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
use Slim\Flash\Messages;

$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'omniasoftinfo_slimstrap',
    'username' => 'omniasoftinfo_slimstrap',
    'password' => 'Da.vi.de.24!', 
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$twig = Twig::create('../templates');

$container->set('flash', function () {
    return new Messages();
});

$container->set('view', function ($container) {
    $settings = $container->get('settings')['twig'];
    $view = new \Slim\Views\Twig($settings['../templates'], $settings);
    return $view;
});

AppFactory::setContainer($container);
AppFactory::setResponseFactory(new ResponseFactory());

$app = AppFactory::create();

return $app;
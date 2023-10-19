<?php

use Psr\Log\LoggerInterface;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

$development = false;
require_once __DIR__ . '/config.php';

$app = AppFactory::create();

$app->addRoutingMiddleware();

$errorMiddleware = $app->addErrorMiddleware($development, $development, $development);

if ($development) {
    $twigOptions = ['cache' => false];
} else {
    $twigOptions = ['cache' => __DIR__ . '/../cache'];
}
$twig = Twig::create(__DIR__ . '/views', $twigOptions);

$app->add(TwigMiddleware::create($app, $twig));

require_once __DIR__ . '/routes.php';

$app->run();

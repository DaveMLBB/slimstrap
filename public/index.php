<?php

require "../bootstrap.php";

use Slim\Psr7\Request;
use Slim\Psr7\Response;

$app->get('/login', '\app\controllers\AuthController:showLoginForm');
$app->post('/login', '\app\controllers\AuthController:login');
$app->get('/register', '\app\controllers\AuthController:showRegistrationForm');
$app->post('/register', '\app\controllers\AuthController:register');
$app->get('/', '\app\controllers\DashboardController:showDashboard');

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$errorMiddleware->setErrorHandler(
    Slim\Exception\HttpNotFoundException::class,
    function (Psr\Http\Message\ServerRequestInterface $request) use ($container) {
        $controller = new app\controllers\ExceptionController($container);
        return $controller->notFound($request);
    });

$app->run();
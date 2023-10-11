<?php

require "../bootstrap.php";

use Slim\Psr7\Request;
use Slim\Psr7\Response;

$app->get('/login', '\app\controllers\AuthController:showLoginForm');
$app->post('/login', '\app\controllers\AuthController:login');
$app->get('/register', '\app\controllers\AuthController:showRegistrationForm');
$app->post('/register', '\app\controllers\AuthController:register');
$app->get('/', '\app\controllers\DashboardController:showDashboard');

$app->run();
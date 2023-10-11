<?php

namespace app\controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class DashboardController extends Controller
{
    public function showDashboard(Request $request, Response $response)
    {
        return $this->view->render($response, 'dashboard.twig', ['title' => 'Dashboard']);
    }
}
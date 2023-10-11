<?php

namespace app\controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

abstract class Controller
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    protected function render(Response $response, $template, $data = [])
    {
        $view = $this->ci->get(Twig::class);

        return $view->render($response, $template, $data);
    }
}

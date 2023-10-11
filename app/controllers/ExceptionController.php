<?php

namespace app\controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response;

class ExceptionController extends Controller
{
    public function notFound(Request $request)
    {
        $response = new Response;
        $response = $response->withStatus(404); 
        $response->getBody()->write('Pagina non trovata'); 
        return $response;
    }
}
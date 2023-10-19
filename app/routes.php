<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;

require_once 'controllers/HomeController.php';

$app->get('/', function (Request $request, Response $response) {
    $data = HomeController::index($request, $response);
    $view = Twig::fromRequest($request);
    return $view->render($response, 'home.twig', $data);
});

$app->any('/add-customer', function (Request $request, Response $response) {
    $homeController = new HomeController(); 
    $data = $homeController->addCustomer($request, $response);
    $view = Twig::fromRequest($request);
    return $view->render($response, 'customer/add_customer.twig', $data);
});

$app->get('/edit-customer', function (Request $request, Response $response) {
    $homeController = new HomeController();
    $data = $homeController->editCustomer($request, $response);
    $view = Twig::fromRequest($request);
    return $view->render($response, 'customer/edit_customer.twig', $data);
});

$app->any('/edit-customer/{id}', function (Request $request, Response $response, $args) {
    $id = $args['id'];
    $homeController = new HomeController();
    $data = $homeController->showEditCustomer($request, $response, $id);
    $view = Twig::fromRequest($request);
    if ($request->getMethod() === 'POST') {
        return $view->render($response, 'customer/edit_customer.twig', $data);
    }
    return $view->render($response, 'customer/edit_customer_form.twig', $data);
});

$app->get('/delete-customer', function (Request $request, Response $response) {
    $data = HomeController::deleteCustomer($request, $response);
    $view = Twig::fromRequest($request);
    return $view->render($response, 'customer/delete_customer.twig', $data);
});

$app->get('/create-invoice', function (Request $request, Response $response) {
    $data = HomeController::createInvoice($request, $response);
    $view = Twig::fromRequest($request);
    return $view->render($response, 'invoice/create_invoice.twig', $data);
});

$app->get('/edit-invoice', function (Request $request, Response $response) {
    $data = HomeController::editInvoice($request, $response);
    $view = Twig::fromRequest($request);
    return $view->render($response, 'invoice/edit_invoice.twig', $data);
});

$app->get('/delete-invoice', function (Request $request, Response $response) {
    $data = HomeController::deleteInvoice($request, $response);
    $view = Twig::fromRequest($request);
    return $view->render($response, 'invoice/delete_invoice.twig', $data);
});


$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    throw new HttpNotFoundException($request);
});

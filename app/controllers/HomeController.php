<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use app\models\Customer;

class HomeController
{

    protected $customer;

    public function __construct()
    {
        $this->customer = new Customer;
    }

    public static function index(Request $request, Response $response)
    {
        $name = 'Homepage';
        return ['name' => $name];
    }

    public function addCustomer(Request $request, Response $response)
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getParsedBody();
            $customer = $this->customer->add($data);
        }
    
        $customers = $this->customer->all();
    
        return ['customers' => $customers];
    }

    public static function editCustomer(Request $request, Response $response, $args)
    {
        // Logica per "Modifica cliente"
    }

    public static function deleteCustomer(Request $request, Response $response, $args)
    {
        // Logica per "Elimina cliente"
    }

    public static function createInvoice(Request $request, Response $response, $args)
    {
        // Logica per "Crea fattura"
    }

    public static function editInvoice(Request $request, Response $response, $args)
    {
        // Logica per "Modifica fattura"
    }

    public static function deleteInvoice(Request $request, Response $response, $args)
    {
        // Logica per "Elimina fattura"
    }
}

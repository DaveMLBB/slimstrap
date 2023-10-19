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

    public function editCustomer(Request $request, Response $response)
    {
        $customers = $this->customer->all();

        return ['customers' => $customers];
    }

    public function showEditCustomer(Request $request, Response $response, $id)
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getParsedBody();
            $customer = $this->customer->update($data, $id);
            $customers = $this->customer->all();
            return ['customers' => $customers];
        }
        $customer = $this->customer->find($id); 
        return ['customer' => $customer,
                'id' => $id
            ];
    }

    public static function deleteCustomer(Request $request, Response $response, $args)
    {

    }

    public static function createInvoice(Request $request, Response $response, $args)
    {

    }

    public static function editInvoice(Request $request, Response $response, $args)
    {

    }

    public static function deleteInvoice(Request $request, Response $response, $args)
    {

    }
}

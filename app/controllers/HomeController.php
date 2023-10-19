<?php

use app\models\Invoice;
use app\models\Customer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Response as SlimResponse;
use TCPDF;

class HomeController
{

    protected $customer;
    protected $invoice;

    public function __construct()
    {
        $this->customer = new Customer;
        $this->invoice = new Invoice;
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

    public function deleteCustomer(Request $request, Response $response,$id)
    {
        if ($request->getMethod() === 'POST') {
            $customer = $this->customer->delete($id);
            $customers = $this->customer->all();
            return ['customers' => $customers];
        }
        $customers = $this->customer->all();

        return ['customers' => $customers];
    }

    public function createInvoice(Request $request, Response $response)
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getParsedBody();
            $invoice = $this->invoice->add($data);
        }
    
        $invoices = $this->invoice->all();
        $customers = $this->customer->all();

        foreach ($invoices as &$invoice) { 
            $id = $invoice->customer_id;
            $customer = $this->customer->find($id);
        
            $invoice = (array) $invoice;
            
            $invoice['customer_name'] = $customer['first_name'] . ' ' . $customer['last_name'];
        }
    
        return ['invoices' => $invoices,
                'customers' => $customers
            ];

    }

    public function downloadInvoice(Request $request, Response $response, $id)
    {
        $invoice = $this->invoice->find($id);
        $customer = $this->customer->find($invoice['customer_id']);

        $pdf = new TCPDF();
        $pdf->AddPage();

        $pdf->SetFont('Helvetica', '', 12);
        $pdf->Cell(0, 10, 'Cliente: ' . $customer['first_name'] . ' ' . $customer['last_name'], 0, 1);

        $pdf->Cell(0, 10, 'Data Fattura: ' . $invoice['data'], 0, 1);
        $pdf->Cell(0, 10, 'Prestazione: ' . $invoice['prestazione'], 0, 1);
        $pdf->Cell(0, 10, 'Metodo di Pagamento: ' . $invoice['metodo_pagamento'], 0, 1);
        $pdf->Cell(0, 10, 'Scadenza Pagamento: ' . $invoice['scadenza_pagamento'], 0, 1);
        $pdf->Cell(0, 10, 'Note: ' . $invoice['note'], 0, 1);

        $pdf->Output('fattura.pdf', 'D');
    }

    private function createPDF($invoice)
    {
        $pdf = new TCPDF();
        $pdf->SetAutoPageBreak(true, 15);

        $pdf->AddPage();

        $html = '<h1>Fattura</h1>';
        $html .= '<p>Numero Fattura: ' . $invoice['numero_fattura'] . '</p>';
        $html .= '<p>Data: ' . $invoice['data'] . '</p>';

        $pdf->writeHTML($html, true, false, true, false, '');

        return $pdf;
    }

    public static function editInvoice(Request $request, Response $response, $args)
    {

    }

    public static function deleteInvoice(Request $request, Response $response, $args)
    {

    }
}

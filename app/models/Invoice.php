<?php

namespace app\models;

use app\models\Model;

class Invoice extends Model{

    protected $table = 'invoice';

    public function add($data) {
        $invoice = new Invoice();
        $invoice->customer_id = $data['cliente'];
        $invoice->data = $data['data'];
        $invoice->prestazione = $data['prestazione'];
        $invoice->metodo_pagamento = $data['metodo_pagamento'];
        $invoice->scadenza_pagamento = $data['scadenza_pagamento'];
        $invoice->note = $data['note'];
    
        $pdo = Connection::connect();
    
        $sql = "INSERT INTO invoice (customer_id, data, prestazione, metodo_pagamento, scadenza_pagamento, note)
                VALUES (:customer_id, :data, :prestazione, :metodo_pagamento, :scadenza_pagamento, :note)";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':customer_id', $invoice->customer_id);
        $stmt->bindParam(':data', $invoice->data);
        $stmt->bindParam(':prestazione', $invoice->prestazione);
        $stmt->bindParam(':metodo_pagamento', $invoice->metodo_pagamento);
        $stmt->bindParam(':scadenza_pagamento', $invoice->scadenza_pagamento);
        $stmt->bindParam(':note', $invoice->note);
    
        $stmt->execute();
    }
}
<?php

namespace app\models;

use app\models\Model;

class Customer extends Model{

    protected $table = 'customer';

    public function add($data){

        $customer = new Customer();
        $customer->first_name = $data['firstName'];
        $customer->last_name = $data['lastName'];
        $customer->address = $data['address'];
        $customer->address_number = $data['addressNumber'];
        $customer->city = $data['city'];
        $customer->zip_code = $data['zipCode'];
        $customer->province = $data['province'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'];
        $customer->tax_code = $data['taxCode'];
        $customer->vat = $data['vat'];
        $customer->pec = $data['pec'];

        $pdo = Connection::connect();

        $sql = "INSERT INTO customer (first_name, last_name, address, address_number, city, zip_code, province, phone, email, tax_code, vat, pec)
        VALUES (:first_name, :last_name, :address, :address_number, :city, :zip_code, :province, :phone, :email, :tax_code, :vat, :pec)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':first_name', $customer->first_name);
        $stmt->bindParam(':last_name', $customer->last_name);
        $stmt->bindParam(':address', $customer->address);
        $stmt->bindParam(':address_number', $customer->address_number);
        $stmt->bindParam(':city', $customer->city);
        $stmt->bindParam(':zip_code', $customer->zip_code);
        $stmt->bindParam(':province', $customer->province);
        $stmt->bindParam(':phone', $customer->phone);
        $stmt->bindParam(':email', $customer->email);
        $stmt->bindParam(':tax_code', $customer->tax_code);
        $stmt->bindParam(':vat', $customer->vat);
        $stmt->bindParam(':pec', $customer->pec);

        $stmt->execute();
    
    }

}
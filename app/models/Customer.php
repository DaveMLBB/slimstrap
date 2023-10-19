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

    public function find($id){

        $pdo = Connection::connect();
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($data, $id)
    {
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

        $sql = "UPDATE {$this->table} SET 
                    first_name = :first_name, 
                    last_name = :last_name, 
                    address = :address, 
                    address_number = :address_number, 
                    city = :city, 
                    zip_code = :zip_code, 
                    province = :province, 
                    phone = :phone, 
                    email = :email, 
                    tax_code = :tax_code, 
                    vat = :vat, 
                    pec = :pec 
                WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':first_name', $data['firstName']);
        $stmt->bindParam(':last_name', $data['lastName']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':address_number', $data['addressNumber']);
        $stmt->bindParam(':city', $data['city']);
        $stmt->bindParam(':zip_code', $data['zipCode']);
        $stmt->bindParam(':province', $data['province']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':tax_code', $data['taxCode']);
        $stmt->bindParam(':vat', $data['vat']);
        $stmt->bindParam(':pec', $data['pec']);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

    }

    public function delete($id)
    {
        $pdo = Connection::connect();

        $sql = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    }

}
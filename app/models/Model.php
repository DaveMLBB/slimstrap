<?php

namespace app\models;

use app\models\Connection;

class Model{

    protected $connect;

    public function __construct()
    {
        $this->connect = Connection::connect(); 
    }

    public function all(){

        $sql = "select * from {$this->table}";
        $all = $this->connect->query($sql);
        $all->execute();

        return $all->fetchAll();
    }

    public function find($id){

        $pdo = Connection::connect();
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
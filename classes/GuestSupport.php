<?php

include_once 'Database.php';
class GuestSupport {
    private $conn;
    private $id;
    private $name;
    private $message;
    private $status;


    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        
    }


    public function fetchById($id)
    {
        
    }

    public function fetchAll()
    {
        
    }

    public function insert()
    {
        # code...
    }

    public function update(Type $var = null)
    {
        # code...
    }

    public function closeSupport(Type $var = null)
    {
        # code...
    }
}
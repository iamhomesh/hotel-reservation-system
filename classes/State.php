<?php

require_once 'Database.php';
class State {
    private $conn;
    private $state_id;
    private $state_name;


    public function __construct()
    {
        $this->setConnection();
    }

    public function setConnection()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function fetchAllState()
    {
        $query = "SELECT * FROM `state`";
        return $this->conn->query($query);
    }



}

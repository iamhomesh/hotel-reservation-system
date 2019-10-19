<?php

require_once 'Database.php';

class State
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllStates()
    {
        $query = "SELECT * FROM `states`";
        return $this->conn->query($query);
    }

    public function getStateName($stateId)
    {
        $query = "SELECT `name` FROM `states` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $stateId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
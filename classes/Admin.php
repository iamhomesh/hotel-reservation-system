<?php
include_once 'Database.php';
class Admin {
    private $conn;
    private $username;
    private $password;

    public function __construct()
    {
        $this->setConnection();
        
    }

    public function setConnection()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    public function login($username, $password)
    {
        $query = "SELECT * FROM `admin` WHERE `username` = ? AND `password` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
        $stmt->execute();
        if($stmt->rowCount() == 1) {
            $this->username = $username;
            $this->password = $password;
            return true;
        } else return false;
    }
}
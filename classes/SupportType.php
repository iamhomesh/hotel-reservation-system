<?php
require_once __DIR__.'/Database.php';
class SupportType {

    private $conn;

    public function __construct()
    {
        $this->setConnection();
    }

    public function setConnection()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }


    public function getAllType()
    {
        $query = "SELECT * FROM `support_type`;";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTypeName($type_id) {
        $query = "SELECT `type_name` FROM `support_type` WHERE `type_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $type_id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['type_name'];
    }
}


// $test = new SupportType();

// echo $test->getTypeName(1);
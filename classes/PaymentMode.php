<?php

require_once 'Database.php';

class PaymentMode
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllPaymentModes(): array
    {
        $query = "SELECT * FROM payment_modes";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
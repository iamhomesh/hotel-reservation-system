<?php

include_once __DIR__. '/Database.php';

class BookingHistory {

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        
    }

    public function getAllByGuestId($guest_id)
    {
        $query = "SELECT * FROM `booking_history` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

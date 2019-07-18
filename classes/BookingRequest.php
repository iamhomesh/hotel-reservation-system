<?php

include_once __DIR__.'/Database.php';

class BookingRequest {
    private $conn;
    private $id;
    private $guest_id;
    private $room_type_id;
    private $check_in;
    private $check_out;
    private $status;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($fields)
    {
        $query = "INSERT INTO `booking_requests` SET ";

        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= ", `status` = 'Pending'";
        $stmt = $this->conn->prepare($query);

        if($stmt->execute($fields)) return true;
        else return false;
    }

    private function processDates($date) {
        $date = new DateTime($date);
        return $date->format('Y-m-d');
    }

    public function fixDate($date)
    {
        $date = new DateTime($date);
        return $date->format('d-M-Y');
    }

    public function getAllByGuestId($guest_id)
    {
        $query = "SELECT * FROM `booking_requests` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function countPending($guest_id) {
        $query = "SELECT COUNT(`id`) FROM `booking_requests` WHERE `guest_id` = ? AND `status` = 'pending'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);

        $stmt->execute();
        return $stmt->fetchColumn();
        
    }
    public function countCancelled($guest_id) {
        $query = "SELECT COUNT(`id`) FROM `booking_requests` WHERE `guest_id` = ? AND `status` = 'cancelled'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);

        $stmt->execute();
        return $stmt->fetchColumn();
        
    }
    public function countConfirmed($guest_id) {
        $query = "SELECT COUNT(`id`) FROM `booking_requests` WHERE `guest_id` = ? AND `status` = 'confirmed'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);

        $stmt->execute();
        return $stmt->fetchColumn();
        
    }
}

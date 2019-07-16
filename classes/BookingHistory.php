<?php

include_once __DIR__. '/Database.php';

class BookingHistory {

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        
    }

    public function fixDate($date)
    {
        $date = new DateTime($date);
        return $date->format('d-M-Y');
    }

    public function countStayed($guest_id)
    {
        $query = "SELECT COUNT(`id`) AS `id`, `room_type`.`type_name` FROM `booking_history`, `rooms`, `room_type` WHERE `rooms`.`type_id` = `room_type`.`type_id` AND `booking_history`.`room_id` = `rooms`.`room_id` AND `booking_history`.`guest_id` = ? GROUP BY `room_type`.`type_id`";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guest_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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


// $test = new BookingHistory();
// echo "<pre>";
// print_r($test->countStayed(1));
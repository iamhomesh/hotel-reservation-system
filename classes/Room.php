<?php


include_once __DIR__ .'/Database.php';

class Room {
    private $conn;
    private $id;
    private $room_no;
    private $type_id;


    public function __construct()
    {
        $this->setConnection();
    }

    
    public function setConnection()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getRoomNo($room_id)
    {
        $query = "SELECT `room_no` FROM `rooms` WHERE `room_id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $room_id);
        $stmt->execute();
        $roomNo = $stmt->fetch(PDO::FETCH_NUM);
        return $roomNo[0];
    }

    public function countAvaiable($type_id) {
        $query = "SELECT COUNT(`room_id`) FROM `rooms` WHERE `type_id` = ? AND `is_available` = 'yes'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $type_id);

        $stmt->execute();
        return $stmt->fetchColumn();
        
    }

}


// $te = new Room();

// echo $te->countAvaiable(1);
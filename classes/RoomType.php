<?php

include_once __DIR__.'/Database.php';

class RoomType {
    private $conn;
    private $id;
    private $name;
    private $rate;
    private $desciption;

    public function __construct() {
        $this->setConnection();
    }

    public function setConnection()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getRoomTypeName($id)
    {
        $query = "SELECT type_name FROM `room_type` WHERE `type_id` = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':id', $id);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['type_name'];
    }

    public function fetchAll()
    {
        $query = "SELECT * FROM `room_type`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            

    }

    public function fetchDesciption($id)
    {
        $query = "SELECT `description`, `rate` FROM `room_type`  WHERE `type_id` = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NUM);
    }

}


// $test = new RoomType();
// echo "<pre>";
// $rr = $test->fetchAll();

// foreach($rr as $key => $value) {
//     echo  $value['type_name'];
// }
<?php

require_once __DIR__ . '/Database.php';

class Room
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getRoomNo($roomId)
    {
        $query = "SELECT `room_no` FROM `rooms` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $roomId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM `rooms`";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAvailableById($typeId)
    {
        $query = "SELECT COUNT(`id`) FROM `rooms` WHERE `type_id` = ? AND `available` = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $typeId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countAvailable()
    {
        $query = "SELECT COUNT(`id`) FROM `rooms` WHERE `available` = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countOccupied()
    {
        $query = "SELECT COUNT(`id`) FROM `rooms` WHERE `available` = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getRoom($roomId): array
    {
        $query = "SELECT * FROM `rooms` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $roomId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add(array $fields): bool
    {
        $query = "INSERT INTO `rooms` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function update($roomId, array $fields): bool
    {
        $query = "UPDATE `rooms` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= " WHERE `id` = $roomId";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function getAvailable(): array
    {
        $query = "SELECT * FROM `rooms` WHERE `available` = 1";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableByType($typeId): array
    {
        $query = "SELECT * FROM `rooms` WHERE `available` = 1 AND `type_id` = :type_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':type_id', $typeId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkRoomNo(string $roomNo, $roomId = null): bool
    {
        $query = "";
        if ($roomId != null) {
            $query = "SELECT COUNT(id) FROM rooms WHERE room_no = :room_no AND id != $roomId";
        } else {
            $query = "SELECT COUNT(id) FROM rooms WHERE room_no = :room_no";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':room_no', $roomNo);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) return true;
        return false;
    }
}
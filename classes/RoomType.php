<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Image.php';

class RoomType
{

    use Image;

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getRoomTypeName($typeId): string
    {
        $query = "SELECT `name` FROM `room_types` WHERE `id` = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $typeId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['name'];
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM `room_types`";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoomType($typeId): array
    {
        $query = "SELECT * FROM `room_types` WHERE `id` = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $typeId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDesciption($typeId): array
    {
        $query = "SELECT `description`, `rate` FROM `room_types`  WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $typeId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_NUM);
    }

    public function checkRoomType(string $typeName, $typeId = null): bool
    {
        $query = "";
        if ($typeId != null) {
            $query = "SELECT COUNT(id) FROM room_types WHERE name = :type_name AND id != $typeId";
        } else {
            $query = "SELECT COUNT(`id`) FROM `room_types` WHERE `name` = :type_name";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':type_name', $typeName);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) return true;
        return false;
    }

    public function add(array $fields): bool
    {
        $query = "INSERT INTO `room_types` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function update($typeId, array $fields): bool
    {
        $query = "UPDATE `room_types` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= " WHERE `id` = $typeId";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }
}
<?php

require_once __DIR__ . '/Database.php';

class Booking
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function countStayed($guestId): array
    {
        $query = "SELECT COUNT(`id`) AS `id`, `room_types`.`name` FROM `bookings`, `rooms`, `room_types` WHERE `rooms`.`id` = `room_type`.`id` AND `bookings`.`room_id` = `rooms`.`room_id` AND `bookings`.`guest_id` = ? GROUP BY `room_types`.`id`";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function checkIn(array $fields, $reservationId = null): bool
    {
        $query = "INSERT INTO `bookings` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) {
            $roomId = $fields['room_id'];
            $query = "UPDATE `rooms` SET `available`= 0 WHERE `id` = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(1, $roomId);
            $stmt->execute();
            if ($reservationId != null) {
                $query = "UPDATE reservations SET status = 4 WHERE id= :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindValue(':id', $reservationId);
                $stmt->execute();
                return true;
            }
            return true;
        }
        return false;
    }

    public function checkOut(array $fields): bool
    {
        $bookingId = $fields['id'];
        $checkOut = date('Y-m-d h:i:s');
        $query = "UPDATE `bookings` SET `staying` = 0, `check_out` = ? WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $checkOut);
        $stmt->bindValue(2, $bookingId);
        if ($stmt->execute()) {
            $roomId = $fields['room_id'];
            $query = "UPDATE `rooms` SET `available`= 1 WHERE `id` = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(1, $roomId);
            $stmt->execute();
            return true;
        }
        return false;
    }

    public function getBooking($bookingId): array
    {
        $query = "SELECT * FROM `bookings` WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $bookingId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllByGuestId($guestId): array
    {
        $query = "SELECT * FROM `bookings` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM `bookings`";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
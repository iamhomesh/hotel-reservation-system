<?php

require_once __DIR__ . '/Database.php';

class Reservation
{

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create(array $fields): bool
    {
        $query = "INSERT INTO `reservations` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= ", `status` = 'Pending'";
        $stmt = $this->conn->prepare($query);

        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function getAllByGuestId($guestId): array
    {
        $query = "SELECT * FROM `reservations` WHERE `guest_id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countPending($guestId)
    {
        $query = "SELECT COUNT(`id`) FROM `reservations` WHERE `guest_id` = ? AND `status` = 'pending'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countCancelled($guestId)
    {
        $query = "SELECT COUNT(`id`) FROM `reservations` WHERE `guest_id` = ? AND `status` = 'cancelled'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function countConfirmed($guestId)
    {
        $query = "SELECT COUNT(`id`) FROM `reservations` WHERE `guest_id` = ? AND `status` = 'confirmed'";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getAll(): array
    {
        $stmt = $this->conn->query("SELECT * FROM `reservations`");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function confirm($reservationId): bool
    {
        $query = "UPDATE `reservations` SET `status` = 'Confirmed' WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $reservationId);
        if ($stmt->execute()) return true;
        return false;
    }

    public function cancel($reservationId): bool
    {
        $query = "UPDATE `reservations` SET `status` = 'Cancelled' WHERE `id` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $reservationId);
        if ($stmt->execute()) return true;
        return false;
    }

    public function getPendings(): array
    {
        $query = "SELECT * FROM reservations WHERE status = 'Pending' ORDER BY reserved_at DESC LIMIT 5";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAllPendings()
    {
        $query = "SELECT COUNT(id) FROM reservations WHERE status = 'Pending'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchColumn();
    }

    public function getReservation($reservationId): array
    {
        $query = "SELECT * FROM reservations WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $reservationId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
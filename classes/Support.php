<?php

require_once  __DIR__ . '/Database.php';
require_once __DIR__ . '/Image.php';

class Support
{

    use Image;

    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    private function generateTicket(): string
    {
        $string = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $ticket = "";
        for ($i = 0; $i <= 4; $i++) {
            $random = rand(0, strlen($string) - 1);
            $ticket .= substr($string, $random, 1);
        }
        $ticket = $ticket . rand(0, 9999999);
        if ($this->checkTicket($ticket)) $this->generateTicket();
        else return $ticket;
    }

    private function checkTicket(string $ticket): bool
    {
        $query = "SELECT `ticket` FROM `supports` WHERE `ticket` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $ticket);
        $stmt->execute();
        if ($stmt->fetch(PDO::FETCH_ASSOC)) return true;
        return false;
    }

    public function getByGuestId($guestId): array
    {
        $query = "SELECT * FROM supports WHERE guest_id = ? ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $guestId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTicket(string $ticket): array
    {
        $query = "SELECT * FROM `supports` WHERE `ticket` = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(1, $ticket);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(array $fields): bool
    {
        $query = "INSERT INTO `supports` SET ";
        foreach ($fields as $key => $value) {
            $query .= "`$key` = :$key, ";
        }
        $ticket = $this->generateTicket();
        $query .= "`ticket` = '$ticket' , `status` = 'Unread'";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function update($supportId, array $fields): bool
    {
        $query = "UPDATE supports SET ";
        foreach ($fields as $key => $value) {
            $query .= "$key = :$key,";
        }
        $query = rtrim($query, ',');
        $query .= " WHERE id = $supportId";
        $stmt = $this->conn->prepare($query);
        if ($stmt->execute($fields)) return true;
        return false;
    }

    public function getUnread(): array
    {
        $query = "SELECT * FROM supports WHERE status = 'Unread' ORDER BY created_at LIMIT 5";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUnread()
    {
        $query = "SELECT COUNT(id) FROM supports WHERE status = 'Unread'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchColumn();
    }

    public function getAllUnread(): array
    {
        $query = "SELECT * FROM supports WHERE status = 'Unread'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRead(): array
    {
        $query = "SELECT * FROM supports WHERE status = 'Read'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSolved(): array
    {
        $query = "SELECT * FROM supports WHERE status = 'Solved'";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGuestSupport($supportId): array
    {
        $query = "SELECT * FROM supports WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $supportId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function read($supportId): bool
    {
        $query = "UPDATE supports SET status = 'Read' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $supportId);
        if ($stmt->execute()) return true;
        return false;
    }

    public function solved($supportId): bool
    {
        $query = "UPDATE supports SET status = 'Solved' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':id', $supportId);
        if ($stmt->execute()) return true;
        return false;
    }
}